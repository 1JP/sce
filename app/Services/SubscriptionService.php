<?php

namespace App\Services;

use App\Mail\CancelSubscription;
use App\Mail\CreateSubscription;
use App\Mail\UpdatePlanSubscription;
use App\Mail\UpdateSubscription;
use App\Models\Plan;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SubscriptionService
{
    public function __construct(protected $paymentApi,protected $bodyPaymentApi
    ) {}
    
    public function store(array $validated, User $user)
    {
        $client = $user->client;

        if (! $client) {
            $pagSeguroCustomer = $this->createGatewaySubscription($validated);

            if($pagSeguroCustomer->error){
                return $pagSeguroCustomer;
            }

            $validated['customer_id'] = $pagSeguroCustomer->id;
            $client = $user->client()->create(
                Arr::except($validated, ['number_card', 'plan_id', 'year', 'month', 'cvv'])
            );
        }else {
            $validated['customer_id'] = $client->customer_id;
        }

        $created = $this->createGatewaySubscription($validated);
        if($created->error){
            return $created;
        }

        $subscription = Subscription::create([
            'plan_id' => $validated['plan_id'],
            'user_id' => $user->id,
            'status' => $this->paymentApi->statusSubscription($created->status),
            'customer_id' => $created->id
        ]);
        
        $user->assignRole('Admin');

        $this->sendCreationEmail($user, $subscription);

        return (object)[
            'error' => 0,
            'message' => 'Assinatura criada com sucesso!',
            'route' => 'home',
            'status' => 'success'
        ];
    }

    public function update(array $validated, Subscription $subscription, User $user)
    {
        $plan = Plan::findOrFail($validated['plan_id']);
 
        if (!$this->planIsActive($plan)) {
            $error = [
                'error' => 1,
                'message' => 'O plano escolhido não está ativo',
                'route' => 'admin.assinaturas.edit',
                'subscription_id' => $subscription->id,
                'status' => 'info'
            ];

            return (object)($error);
        }

        $currentSubscription = $this->paymentApi->getSubscription($subscription->customer_id);
        $cardMatches = $this->cardMatchesCurrentSubscription($validated['number_card'], $currentSubscription);
        $planChanged = $plan->id !== $subscription->plan_id;
        $plandOld = Plan::findOrFail($subscription->plan_id);

        $pagSeguroSubscription = ($cardMatches && $planChanged)
            ? $this->updateGatewaySubscription($validated, $subscription)
            : $this->cancelAndCreateNewSubscription($validated, $subscription, $user);
        
        if (is_object($pagSeguroSubscription) && isset($pagSeguroSubscription->error)) {
            return $pagSeguroSubscription;
        }

        $subscription->update([
            'plan_id'     => $validated['plan_id'],
            'status'      => $this->paymentApi->statusSubscription($pagSeguroSubscription->status),
            'customer_id' => $pagSeguroSubscription->id,
        ]);

        if($cardMatches && $planChanged){
            $this->sendUpdatePlanGatewayEmail($user, $subscription, $plandOld);
        }else {
            $this->sendUpdateGatewayEmail($user, $subscription);
        }

        return (object)[
            'error' => 0,
            'message' => 'Assinatura alterada com sucesso!',
            'route' => 'admin.assinaturas.index',
            'status' => 'success'
        ];
    }

    public function destroy(Subscription $subscription)
    {
        $pagSeguroSubscriptionCancel = $this->paymentApi->cancelSubscription($subscription->customer_id);
        if (count((array) $pagSeguroSubscriptionCancel) > 1) {
            $error = [
                'error' => 1,
                'message' => 'Falha ao cancelar a assinatura atual.',
                'route' => 'admin.assinaturas.index',
                'status' => 'danger'
            ];

            return (object)($error);
        }

        $status = $this->paymentApi->statusSubscription('CANCELED');

        $subscription->update([
            'status' => $status
        ]);

        $this->sendCancelSubscription($subscription->user, $subscription);

        return (object)[
            'error' => 0,
            'message' => 'Assinatura excluida com sucesso!',
            'route' => 'admin.assinaturas.index',
            'status' => 'success'
        ];
    }

    protected function planIsActive(Plan $plan): bool
    {
        $getPlan = $this->paymentApi->getPlan($plan->customer_id);
 
        return $getPlan->status === 'ACTIVE';
    }

    protected function cardMatchesCurrentSubscription(string $cardNumber, object $currentSubscription): bool
    {
        $card = $currentSubscription->payment_method[0]->card;
 
        $first6 = Str::substr($cardNumber, 0, 6);
        $last4  = Str::substr($cardNumber, -4);
 
        return $card->first_digits === $first6 && $card->last_digits === $last4;
    }

    protected function createGatewaySubscription(array $validated)
    {
        $bodySubscription = $this->bodyPaymentApi->bodyCreateSubscription($validated);
        $pagSeguroSubscription = $this->paymentApi->createSubscription($bodySubscription);
 
        if (!isset($pagSeguroSubscription->id)) {
            $error = [
                'error' => 1,
                'message' => 'Não foi possível gerar a assinatura!',
                'route' => $validated['subscription_id'] ? 'admin.assinaturas.edit': 'pagamento.create',
                'subscription_id' => $validated['subscription_id'] ?? null,
                'status' => 'danger'
            ];

            return (object)($error);
        }
 
        return $pagSeguroSubscription;
    }

    protected function updateGatewaySubscription(array $validated, Subscription $subscription)
    {
        $body = $this->bodyPaymentApi->bodyUpdateSubscription($validated);
        $pagSeguroSubscription = $this->paymentApi->updateSubscription($body, $subscription->customer_id);
        $sandbox = Setting::where('name', 'sandbox-payment')->first();

        if (!isset($pagSeguroSubscription->id)) {
            $errorCode = $pagSeguroSubscription->error_messages[0]->error ?? null;
            if ($errorCode == 'plan_trial_subscriptions' && $sandbox->body == "1"){
                $pagSeguroSubscription = (object)[
                    'status' => $subscription->status,
                    'id' => $subscription->customer_id
                ];
            } else{
                $error = [
                    'error' => 1,
                    'message' => 'Não foi possível trocar o plano dessa assinatura!',
                    'route' => 'admin.assinaturas.edit',
                    'subscription_id' => $subscription->id,
                    'status' => 'danger'
                ];

                return (object)($error);
            }
        }
 
        return $pagSeguroSubscription;
    }

    protected function cancelAndCreateNewSubscription(array $validated, Subscription $subscription, User $user)
    {
        $cancelResult = $this->paymentApi->cancelSubscription($subscription->customer_id);

        if (count((array) $cancelResult) > 1) {
            $error = [
                'error' => 1,
                'message' => 'Falha ao cancelar a assinatura atual. A criação de uma nova assinatura com os dados atualizados não foi realizada.',
                'route' => 'admin.assinaturas.edit',
                'subscription_id' => $subscription->id,
                'status' => 'danger'
            ];

            return (object)($error);
        }
        $validated['subscription_id'] = $subscription->id;
        $validated['customer_id'] = $user->client->customer_id;
 
        return $this->createGatewaySubscription($validated);
    }

    protected function sendUpdatePlanGatewayEmail(User $user, Subscription $subscription, Plan $planOld): void
    {
        try {
            Mail::to($user->email)->send(new UpdatePlanSubscription(
                $user->email,
                $subscription->plan->name,
                $planOld->name,
                $subscription->plan->value,
                $planOld->value,
                $subscription->plan->number_film,
                $subscription->plan->number_serie,
                $subscription->plan->number_book
            ));
        } catch (\Exception $e) {
            report($e);
        }
    }

    protected function sendUpdateGatewayEmail(User $user, Subscription $subscription): void
    {
        try {
            Mail::to($user->email)->send(new UpdateSubscription(
                $user->email,
                $subscription->plan->name,
                $subscription->plan->value,
                $subscription->plan->number_film,
                $subscription->plan->number_serie,
                $subscription->plan->number_book
            ));
        } catch (\Exception $e) {
            report($e);
        }
    }

    protected function sendCancelSubscription(User $user, Subscription $subscription): void
    {
        try {
            Mail::to($user->email)->send(new CancelSubscription(
                $user->email,
                $subscription->plan->name,
                $subscription->plan->value,
                $subscription->plan->number_film,
                $subscription->plan->number_serie,
                $subscription->plan->number_book
            ));
        } catch (\Exception $e) {
            dd($e);
            report($e);
        }
    }

    protected function sendCreationEmail(User $user, Subscription $subscription): void
    {
        try {
            Mail::to($user->email)->send(new CreateSubscription(
                $user->email,
                $subscription->plan->name,
                $subscription->plan->value,
                $subscription->plan->number_film,
                $subscription->plan->number_serie,
                $subscription->plan->number_book
            ));
        } catch (\Exception $e) {
            report($e);
        }
    }
}
