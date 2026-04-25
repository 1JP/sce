<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PendingActionController extends Controller
{

    /**
     * Execute the pending action stored in the session after user authentication.
     * Recreates the original request (URL, method and data) and dispatches it internally.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
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

        $newRequest->setLaravelSession($request->session());
        auth()->setUser(auth()->user());

        return app()->handle($newRequest);
    }
}
