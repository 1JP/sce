<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class SiteUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('site.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $token)
    {
        $reset = PasswordResetToken::where('token', '=', $token)->first();
        
        if (!$reset) {
            return redirect()->route('login')
                ->with('danger', 'O token inserindo não foi encontrado');
        }
        
        return view('site.user.create', [
            'email' => $reset->email,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        try {
            $validated = $request->validated();
            $password = $validated['password'];
            $validated['password'] = Hash::make($validated['password']);
            $user = User::create($validated);
            $user->assignRole('Usuario');
            PasswordResetToken::where('email', '=', $validated['email'])->delete();
            
            if (Auth::attempt(['email' => $validated['email'], 'password' => $password])) {
                session()->put('validation', Crypt::encrypt($password));
            }

            return redirect()->route('home')->with('success', 'Usuário Cadastrado com sucesso!');
        }catch (\Exception $e) {
            $reset = PasswordResetToken::where('email', '=', $validated['email'])->first();
            return redirect()->route('usuarios.create', $reset->token)
                ->with('danger', 'Não foi possível fazer o cadastro!');
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
    public function update(CreateUserRequest $request, User $user)
    {
        $this->authorize('update', Auth::user());
        
        try {
            $validated = $request->validated();
            if (isset($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            }else{
                $validated = Arr::except($validated, ['password']);
            }
            
            $user->update($validated);

            return redirect()->route('usuarios.index')->with('success', 'Usuário Cadastrado com sucesso!');
        }catch (\Exception $e) {
            return redirect()->route('usuarios.index')
                ->with('danger', 'Não foi possível fazer o cadastro!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
