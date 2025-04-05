<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetToken;
use Illuminate\Http\Request;

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
        
        return view('site.user.create', [
            'email' => $reset->email
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
