<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use App\Services\BodyPaymentApiService;
use App\Services\PaymentApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PlanController extends Controller
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
        if (Gate::denies('viewAny', Auth::user())) {
            abort(403);
        }

        $ths = [
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7', 'name' => 'Plano'],
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2', 'name' => 'Descrição'],
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2', 'name' => 'Ativo'],
            ['class' => 'text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7', 'name' => 'N° de Filmes'],
            ['class' => 'text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7', 'name' => 'N° de Livros'],
            ['class' => 'text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7', 'name' => 'N° de Series'],
            ['class' => 'text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7', 'name' => 'Assinatura'],
            ['class' => 'text-secondary opacity-7', 'name' => '']
        ];

        return view('admin.plan.index', compact('ths'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanRequest $request)
    {
        if (Gate::denies('create', Auth::user())) {
            abort(403);
        }

        try {
            $validated = $request->validated();
            $body = $this->preparePaymentData($validated);
            $payment = $this->paymentApi->createPlan($body);
            
            if (isset($payment->error_messages)) {
                return redirect()->route('admin.planos.index')->with('danger', 'Não foi possivel criar o plano!');
            }

            $validated['customer_id'] = $payment->id;
            
            Plan::create($validated);

            return redirect()->route('admin.planos.index')->with('success', 'Plano criada com sucesso!');

        } catch (\Exception $e) {
            return redirect()->route('admin.planos.index')->with('danger', 'Não foi possível criar a plano!');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    private function preparePaymentData(array $validated)
    {
        $value = (int) ($validated['value'] * 100);
        return $this->bodyPaymentApi->bodyCreatePlan($value, $validated['name'], $validated['description']);
    }
}
