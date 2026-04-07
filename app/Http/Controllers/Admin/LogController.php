<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ths = [
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7', 'name' => 'Usuário'],
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2', 'name' => 'Ação'],
            ['class' => 'text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7', 'name' => 'Descrição'],
            ['class' => 'text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7', 'name' => 'Horário'],
            ['class' => 'text-secondary opacity-7', 'name' => '']
        ];

        return view('admin.log.index', compact('ths'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.log.show');
    }

}
