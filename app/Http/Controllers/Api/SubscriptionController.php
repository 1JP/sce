<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceResource;
use App\Services\PaymentApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    /**
     * Class constructor to initialize the service for PaymentApi.
     *
     * @param PaymentApi $paymentApi The service used to interact with the payment API.
     */
    private $paymentApi;

    public function __construct(PaymentApi $paymentApi)
    {
        $this->paymentApi = $paymentApi;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        if(!$user->hasRole(['Root', 'Admin'])){
            abort(403);
        }

        return $user->client;
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
    public function store(Request $request)
    {
        //
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

    public function invoices(string $subscription_id)
    {
        $result = $this->paymentApi->getSubscriptionInvoice($subscription_id);

        $invoices = collect($result->invoices)->flatMap(function ($invoice) {
            $payments = $this->paymentApi->invoices($invoice->id);

            return collect($payments->payments)->map(function ($payment) use ($invoice) {
                return (object) [
                    'value' => number_format($invoice->amount->value / 100, 2, ',', '.'),
                    'status' => $payment->status,
                    'created_at' => Carbon::parse($payment->created_at)->format('d/m/Y H:i:s')
                ];
            });
        });

        return InvoiceResource::collection($invoices);
    }
}
