<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Client;
use App\Models\Subscription;
use App\Services\BodyPaymentApiService;
use App\Services\PaymentApi;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
     * Constructor method to inject the BodyPaymentApiService dependency.
     * This allows the class to interact with the BodyPaymentApiService for handling payment-related logic.
     *
     * @param BodyPaymentApiService $bodyPaymentApi The service that handles the payment API requests.
     */
    public function __construct(BodyPaymentApiService $bodyPaymentApi, PaymentApi $paymentApi)
    {
        $this->bodyPaymentApi = $bodyPaymentApi;
        $this->paymentApi = $paymentApi;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('site.payment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request)
    {
        
        try {
            $validated = $request->validated();
            $user = Auth::user();
            $client = $user->client;
            if (! $client) {
                $bodyCustomer = $this->bodyPaymentApi->bodyCreateCustomer($validated);
                $pagSeguroCustomer = $this->paymentApi->createCustomer($bodyCustomer);

                if (!isset($pagSeguroCustomer->id)) {
                    return redirect()->route('pagamento.create')
                        ->with('danger', 'Não foi possível cadastrar o novo cliente!');
                }

                $validated['customer_id'] = $pagSeguroCustomer->id;
                $client = $user->client()->create(
                    Arr::except($validated, ['number_card', 'plan_id', 'year', 'month'])
                );
            } else {
                $validated['customer_id'] = $client->customer_id;
            }
            
            $bodySubscription = $this->bodyPaymentApi->bodyCreateSubscription($validated);
            $pagSeguroSubscription = $this->paymentApi->createSubscription($bodySubscription);

            if (!isset($pagSeguroSubscription->id)) {
                return redirect()->route('pagamento.create')
                    ->with('danger', 'Não foi possível gerar a assinatura!');
            }
            
            $status = $this->paymentApi->statusSubscription($pagSeguroSubscription->status);

            Subscription::create([
                'plan_id' => $validated['plan_id'],
                'user_id' => Auth::user()->id,
                'status' => $status,
                'customer_id' => $pagSeguroSubscription->id
            ]);
            
            $user->assignRole('Admin');

            return redirect()->route('home')
                ->with('success', 'Assinatura criada com sucesso!');

        } catch (\Exception $e) {
            return redirect()->route('pagamento.create')->with('danger', 'Não foi possível gerar a assinatura!');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('site.payment.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
