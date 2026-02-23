<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check() && !Auth::user()->hasAnyRole(['Admin', 'Membros', 'Root', 'Client'])){
            return redirect()->route('home');
        }

        return view('admin.dashboard.index');
    }

}
