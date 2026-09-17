<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberAccessRequest;
use App\Http\Requests\MemberAccessStoreRequest;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MemberAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MemberAccessRequest $request)
    {
        $validated = $request->validated();
        $email = $validated['email'];
        $token = $validated['token'];
        
        $record = PasswordResetToken::where('email', $email)->latest()->first();

        if (!$record || !Hash::check($token, $record->token)) {
            return redirect()->route('ative-member', [
                'email' => $email, 
                'token' => $token
            ])->with('danger', 'Token inválido ou expirado.');
        }

        $user = User::where('email', $record->email)->first();

        if(! $user){
            return redirect()->route('ative-member', [
                'email' => $email, 
                'token' => $token
            ])->with('danger', 'Usuário não encontrado');
        }

        return view('admin.member.active', compact('record', 'token'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberAccessStoreRequest $request)
    {
        try {
            $validated = $request->validated();
            $email = $validated['email'];
            $token = $validated['token'];
            $password = $validated['password'];

            $record = PasswordResetToken::where('email', $email)->latest()->first();
            
            if (!$record || !Hash::check($token, $record->token)) {
                return redirect()->route('ative-member', [
                    'email' => $email, 
                    'token' => $token
                ])->with('danger', 'Token inválido ou expirado.');
            }
            
            $user = User::where('email', $record->email)->first();

            if(! $user){
                return redirect()->route('ative-member', [
                    'email' => $email, 
                    'token' => $token
                ])->with('danger', 'Usuário não encontrado');
            }

            $user->update([
                'password' => Hash::make($password),
                'email_verified_at' => now()
            ]);

            PasswordResetToken::where('email', $email)->delete();

            return redirect()->route('login')
                ->with('success', "Bem-vindo ao SCE, {$user->name}! Sua conta foi ativada com sucesso.");

        } catch (\Exception $e) {
            return redirect()->route('ative-member', [
                'email' => $email, 
                'token' => $token
            ])->with('danger', 'Não foi possível ativar a conta!');
        }
        
    }

}
