<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/home', function(){
        return view('admin.index');
    })->name('dashboard');
});
