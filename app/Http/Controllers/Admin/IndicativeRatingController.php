<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndicativeRequest;
use App\Models\IndicativeRating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class IndicativeRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('viewAny', Auth::user())) {
            abort(403);
        }

        $ths = [
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7', 'name' => 'Indicação'],
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2', 'name' => 'Descrição'],
            ['class' => 'text-secondary opacity-7', 'name' => '']
        ];

        return view('admin.indicative-rating.index', compact('ths'));
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
    public function store(IndicativeRequest $request)
    {
        if (Gate::denies('create', Auth::user())) {
            abort(403);
        }

        try {
            IndicativeRating::create($request->validated());

            return redirect()->route('admin.classificacao-indicativas.index')->with('success', 'Classificação Inidicativa criada com sucesso!');
        }   catch (\Exception $e) {
            return redirect()->route('admin.classificacao-indicativas.index')->with('danger', 'Não foi possível criar a classificação inidicativa!');
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
    public function update(IndicativeRequest $request, IndicativeRating $indicative)
    {
        if (Gate::denies('update', Auth::user())) {
            abort(403);
        }

        try {
            $indicative->update($request->validated());

            return redirect()->route('admin.classificacao-indicativas.index')->with('success', 'Classificação Inidicativa alterado com sucesso!');
        }   catch (\Exception $e) {
            return redirect()->route('admin.classificacao-indicativas.index')->with('danger', 'Não foi possível alterar a classificação inidicativa!');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IndicativeRating $indicative)
    {
        if (Gate::denies('delete', Auth::user())) {
            abort(403);
        }

        try {
            $indicative->delete();

            return redirect()->route('admin.classificacao-indicativas.index')->with('success', 'Classificação Inidicativa excluida com sucesso!');
        }   catch (\Exception $e) {
            return redirect()->route('admin.classificacao-indicativas.index')->with('danger', 'Não foi possível excluir a classificação inidicativa!');
        }
    }
}
