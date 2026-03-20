<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccessRequest;
use App\Mail\FirstcAccess;
use App\Models\PasswordResetToken;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.first-access');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccessRequest $request)
    {

        try {
            
            $token = Str::random(32);

            PasswordResetToken::create([
                'token' => $token,
                'email' => $request->validated()['email']
            ]);

            Mail::to($request->validated()['email'])
                ->send(new FirstcAccess($request->validated()['email'], $token));

            return redirect()->route('login')->with('success', 'Foi enviado um e-mail para '.$request->validated()['email'].' cadastrar seus dados');
            
        } catch (\Exception $e) {
            return redirect()->route('first-access')->with('danger', 'Não foi possível fazer o primeiro acesso!');
        }
        
    }
}
