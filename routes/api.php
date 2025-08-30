<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CategoryTypeController;
use App\Http\Controllers\Api\IndicativeRatingController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('search', [CategoryController::class, 'search'])->name('search');
    });
    Route::apiResource('categories', CategoryController::class);

    Route::prefix('categorie-types')->name('categorie-types.')->group(function () {
        Route::get('search', [CategoryTypeController::class, 'search'])->name('search');
    });
    Route::apiResource('categorie-types', CategoryTypeController::class);

    Route::prefix('indicative-rating')->name('indicative-rating.')->group(function () {
        Route::get('search', [IndicativeRatingController::class, 'search'])->name('search');
    });
    Route::apiResource('indicative-rating', IndicativeRatingController::class);

    Route::prefix('plans')->name('plans.')->group(function () {
        Route::get('search', [PlanController::class, 'search'])->name('search');
    });
    Route::apiResource('plans', PlanController::class);

    Route::apiResource('posts', PostController::class);
});

Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});
