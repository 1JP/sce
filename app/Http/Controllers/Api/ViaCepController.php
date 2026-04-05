<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use \App\Services\ViaCepService;

class ViaCepController extends Controller
{
    private $viaCepService;

    public function __construct(ViaCepService $viaCepService)
    {
        $this->viaCepService = $viaCepService;
    }
    
    public function getAddressByCep(string $cep)
    {
        $address = $this->viaCepService->getAddressByCep($cep);
        return response()->json($address);
    }
}
