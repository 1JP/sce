<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function firstAccess()
    {
        return view('auth.first-access');
    }

    public function forgotPassword()
    {
        return view('auth.passwords.forgot-password');
    }
}
