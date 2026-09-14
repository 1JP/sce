<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Services\PaymentApi;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ClientController extends Controller
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
        $this->authorize('viewAny', Client::class);

        $ths = [
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7', 'name' => 'Cliente'],
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2', 'name' => 'Assinatura'],
            ['class' => 'text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7', 'name' => 'Post'],
            ['class' => 'text-secondary opacity-7', 'name' => '']
        ];

        return view('admin.client.index', compact('ths'));
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
    public function show(Client $client)
    {
        $this->authorize('view', $client);

        return view('admin.client.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        $this->authorize('update', $client);

        return view('admin.client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, Client $client)
    {
        $this->authorize('update', $client);

        try {
            $validated = $request->validated();

            $client->update(Arr::except($validated, ['username']));

            $user = $client->user;
            if($user->name != $validated['username']){
                $user->update([
                    'name' => $validated['username']
                ]);
            }

            return redirect()->route('admin.clientes.edit', $client->id)->with('success', 'Cliente alterada com sucesso!');
        }   catch (\Exception $e) {
            return redirect()->route('admin.clientes.edit', $client->id)->with('danger', 'Não foi possível alterar a Cliente!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);

        try {

            $subscription = $client->user->subscription;
            $pagSeguroSubscriptionCancel = $this->paymentApi->cancelSubscription($subscription->customer_id);

            if (count((array) $pagSeguroSubscriptionCancel) > 1) {
                return redirect()->route('admin.assinaturas.index')
                    ->with('danger', 'Falha ao cancelar a assinatura atual.');
            }

            $status = $this->paymentApi->statusSubscription('CANCELED');

            $subscription->update([
                'status' => $status
            ]);

            $client->delete();

            $client->user->posts->update([
                'active' => 1
            ]);
            return redirect()->route('admin.clientes.index')->with('success', 'Cliente removida com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.clientes.index')->with('danger', 'Não foi possível removida a Cliente!');
        }
    }
}
