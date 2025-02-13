<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryTypeRequest;
use App\Http\Resources\CategoryTypeResource;
use App\Models\CategoryType;
use Illuminate\Http\Request;

class CategoryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ths = [
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7', 'name' => 'Categoria'],
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2', 'name' => 'Descrição'],
            ['class' => 'text-secondary opacity-7', 'name' => '']
        ];

        return view('admin.category-type.index', compact('ths'));
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
    public function store(CategoryTypeRequest $request)
    {
        try {
            CategoryType::create($request->validated());

            return redirect()->route('admin.tipos-de-categorias.index')->with('success', 'Categoria criada com sucesso!');
        }   catch (\Exception $e) {
            return redirect()->route('admin.tipos-de-categorias.index')->with('danger', 'Não foi possível criar a categoria!');
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
    public function update(CategoryTypeRequest $request, CategoryType $type)
    {

        try {
            $type->update($request->validated());

            return redirect()->route('admin.tipos-de-categorias.index')->with('success', 'Categoria alterada com sucesso!');
        }   catch (\Exception $e) {
            return redirect()->route('admin.tipos-de-categorias.index')->with('danger', 'Não foi possível alterar a categoria!');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryType $type)
    {
        try {
            $type->categories()->detach();
            $type->delete();

            return redirect()->route('admin.tipos-de-categorias.index')->with('success', 'Categoria removida com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.tipos-de-categorias.index')->with('danger', 'Não foi possível removida a categoria!');
        }
    }
}
