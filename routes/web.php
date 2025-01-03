<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryTypeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\IndicativeRatingController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/categorias', CategoryController::class);
    Route::resource('/tipos-de-categorias', CategoryTypeController::class);
    Route::resource('/posts', PostController::class);
    Route::prefix('report')->name('report.')->group(function () {
        Route::get('/relatorio-geral', [ReportController::class, 'generalReport'])->name('general');
        Route::get('/relatorio-comentarios', [ReportController::class, 'commentReport'])->name('comment');
    });
    Route::resource('/planos', PlanController::class);
    Route::resource('classificacao-indicativas', IndicativeRatingController::class);
});
