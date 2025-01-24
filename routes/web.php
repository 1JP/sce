<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryTypeController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\IndicativeRatingController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SiteCategoryController;
use App\Http\Controllers\SitePostController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/primeiro-acesso', [LoginController::class, 'firstAccess'])->name('first-access');
Route::get('/esqueci-minha-senha', [LoginController::class, 'forgotPassword'])->name('forgot-password');

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
    Route::resource('/classificacao-indicativas', IndicativeRatingController::class);
    Route::resource('/assinaturas', SubscriptionController::class);
    Route::resource('/clientes', ClientController::class);
    Route::resource('/membros', MemberController::class);
    Route::resource('/logs', LogController::class);
    Route::resource('/perimissoes', PermissionController::class);
    Route::resource('/configuracoes', SettingController::class);
    Route::resource('/profiles', ProfileController::class);
});

Route::get("/", [HomeController::class, 'index'])->name('home');
Route::resource('/posts', SitePostController::class);
Route::resource('/categorias', SiteCategoryController::class);
Route::resource('/pagamento', PaymentController::class);