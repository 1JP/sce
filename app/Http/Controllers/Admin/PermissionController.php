<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Auth::user());

        $ths = [
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7', 'name' => 'Permissão'],
            ['class' => 'text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7', 'name' => 'Usuários'],
            ['class' => 'text-secondary opacity-7', 'name' => '']
        ];

        return view('admin.permission.index', compact('ths'));
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
    public function store(RoleRequest $request)
    {
        $this->authorize('create', Auth::user());

        try {
            Role::create($request->validated());

            return redirect()->route('admin.permissoes.index')->with('success', 'Permissão criada com sucesso!');
        }   catch (\Exception $e) {
            return redirect()->route('admin.permissoes.index')->with('danger', 'Não foi possível criar a permissão!');
        }
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
    public function update(RoleRequest $request, Role $role)
    {
        $this->authorize('update', Auth::user());

        try {
            $role->update($request->validated());

            return redirect()->route('admin.permissoes.index')->with('success', 'Permissão atualizada com sucesso!');
        }   catch (\Exception $e) {
            return redirect()->route('admin.permissoes.index')->with('danger', 'Não foi possível atualizar a permissão!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', Auth::user());

        try {
            $role->delete();

            return redirect()->route('admin.permissoes.index')->with('success', 'Permissão excluída com sucesso!');
        }   catch (\Exception $e) {
            return redirect()->route('admin.permissoes.index')->with('danger', 'Não foi possível excluir a permissão!');
        }
    }
}
