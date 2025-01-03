<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
}
