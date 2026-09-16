<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\PaymentRequest;
use App\Models\Plan;
use App\Models\Subscription;
use App\Services\BodyPaymentApiService;
use App\Services\PaymentApi;
use App\Services\SubscriptionService;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Class constructor to initialize the service for BodyPaymentApiService.
     *
     * @param BodyPaymentApiService $bodyPaymentApi The service used to interact with the payment API.
     */
    private $bodyPaymentApi;

    /**
     * Class constructor to initialize the service for PaymentApi.
     *
     * @param PaymentApi $paymentApi The service used to interact with the payment API.
     */
    private $paymentApi;

    /**
     * The subscription service instance, responsible for handling
     * subscription creation, updates, and related payment gateway logic.
     *
     * @var \App\Services\SubscriptionService
     */
    private $subscriptionService;

    /**
     * Constructor method to inject the BodyPaymentApiService dependency.
     * This allows the class to interact with the BodyPaymentApiService for handling payment-related logic.
     *
     * @param BodyPaymentApiService $bodyPaymentApi The service that handles the payment API requests.
     */
    public function __construct(BodyPaymentApiService $bodyPaymentApi, PaymentApi $paymentApi)
    {
        $this->bodyPaymentApi = $bodyPaymentApi;
        $this->paymentApi = $paymentApi;
        $this->subscriptionService = new SubscriptionService($this->paymentApi, $this->bodyPaymentApi);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateRequest $request)
    {
        $validated = $request->validated();
        $plan = null;
        if (isset($validated['plan_id'])) {
            $plan = Plan::find($validated['plan_id']);
            if (! $plan || ! $plan->active) {
                return redirect()->route('home')->with('info', 'Plano não encontrado ou inativo.');
            }
        }

        return view('site.payment.create', compact('plan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request)
    {
        try {
            $validated = $request->validated();
            $user = Auth::user();
            $result = $this->subscriptionService->store($validated, $user);

            if($result->error){
                return redirect()->route($result->route)
                    ->with($result->status, $result->message);
            }

            return redirect()->route($result->route)
                ->with($result->status, $result->message);

        } catch (\Exception $e) {
            return redirect()->route('pagamento.create')->with('danger', 'Não foi possível gerar a assinatura!');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentRequest $request, Subscription $subscription)
    {
        $this->authorize('update', $subscription);

        try {
            $validated = $request->validated();
            $user = Auth::user();
            
            $result = $this->subscriptionService->update($validated, $subscription, $user);

            if($result->error){
                return redirect()->route($result->route, $result->subscription_id)
                    ->with($result->status, $result->message);
            }

            return redirect()->route($result->route)
                    ->with($result->status, $result->message);
        } catch (\Exception $e) {
            return redirect()->route('admin.assinaturas.edit', $subscription->id)->with('danger', 'Não foi possível gerar a assinatura!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        $this->authorize('delete', $subscription);
        
        try {
            $result = $this->subscriptionService->destroy($subscription);

            if($result->error){
                return redirect()->route($result->route)
                    ->with($result->status, $result->message);
            }

            return redirect()->route($result->route)
                    ->with($result->status, $result->message);
        }catch (\Exception $e) {
            return redirect()->route('admin.assinaturas.index')
                ->with('danger', 'Falha ao cancelar a assinatura atual.');
        }
    }

}
