<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PendingActionController extends Controller
{
    public function execute(Request $request)
    {
        $pending = session()->pull('pending_action');

        if (!$pending) {
            return redirect()->intended('/');
        }

        $newRequest = Request::create(
            $pending['url'],
            $pending['method'],
            $pending['data']
        );

        // Mantém o usuário autenticado na nova request
        $newRequest->setLaravelSession($request->session());
        auth()->setUser(auth()->user());

        return app()->handle($newRequest);
    }
}
