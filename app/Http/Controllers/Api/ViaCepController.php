<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use \App\Services\ViaCepService;

class ViaCepController extends Controller
{
    /**
     * The ViaCep service instance.
     */
    private $viaCepService;

    /**
     * Create a new controller instance.
     */
    public function __construct(ViaCepService $viaCepService)
    {
        $this->viaCepService = $viaCepService;
    }
    
    /**
     * Get address by CEP
     */
    public function getAddressByCep(string $cep)
    {
        $address = $this->viaCepService->getAddressByCep($cep);
        return response()->json($address);
    }
}
