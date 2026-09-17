<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.profile.index');
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
    public function store(ProfileRequest $request)
    {
        try{
            $validated = $request->validated();
            if (isset($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            }else{
                unset($validated['password']);
            }
            $user = auth()->user();
            $user->update($validated);

            return redirect()->route('admin.profiles.index')
                ->with('success', 'Perfil atualizado com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('admin.profiles.index')
                ->with('danger', 'Ocorreu um erro ao atualizar o perfil');
        }
        
    }
}
