<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SavePendingComment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() && $request->isMethod('post')) {
            // Salva os dados do formulário na session
            session()->put('pending_comment', $request->all());
            
            // Redireciona para login
            return redirect()->route('login');
        }

        return $next($request);
    }
}
