<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CategoryTypeController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\DesLinkController;
use App\Http\Controllers\Api\IndicativeRatingController;
use App\Http\Controllers\Api\LinkController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\PostImageController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\ViaCepController;
use App\Http\Controllers\Api\LogController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\SitePostController;
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

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/indicative-rating', [IndicativeRatingController::class, 'index'])->name('indicative-rating.index');
Route::get('/all-posts', [PostController::class, 'all'])->name('posts.all');
Route::get('/all-plans', [PlanController::class, 'all'])->name('plans.all');
Route::get('/posts/{post}/comments', [PostController::class, 'comments'])->name('posts.comments');
Route::get('/categories/{category}/posts', [CategoryController::class, 'myPosts'])->name('categories.posts');
Route::get('/categories/posts/search', [SitePostController::class, 'search'])->name('site.posts.search');
Route::get('links', [SettingController::class, 'links'])->name('settings.links');

Route::middleware('auth:sanctum')->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('search', [CategoryController::class, 'search'])->name('search');
    });
    Route::apiResource('categories', CategoryController::class)->except(['index']);

    Route::prefix('categorie-types')->name('categorie-types.')->group(function () {
        Route::get('search', [CategoryTypeController::class, 'search'])->name('search');
    });
    Route::apiResource('categorie-types', CategoryTypeController::class);

    Route::prefix('indicative-rating')->name('indicative-rating.')->group(function () {
        Route::get('search', [IndicativeRatingController::class, 'search'])->name('search');
    });
    Route::apiResource('indicative-rating', IndicativeRatingController::class)->except(['index']);

    Route::prefix('plans')->name('plans.')->group(function () {
        Route::get('search', [PlanController::class, 'search'])->name('search');
    });
    Route::apiResource('plans', PlanController::class);

    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('search', [PostController::class, 'search'])->name('search');
    });
    Route::apiResource('posts', PostController::class);
    Route::apiResource('post-image', PostImageController::class);

    Route::prefix('members')->name('members.')->group(function () {
        Route::get('search', [MemberController::class, 'search'])->name('search');
    });
    Route::apiResource('members', MemberController::class);

    Route::prefix('subscription')->name('subscription.')->group(function () {
        Route::get('invoices/{customer_id}', [SubscriptionController::class, 'invoices'])->name('invoices');
    });
    Route::apiResource('subscription', SubscriptionController::class);
    Route::apiResource('settings', SettingController::class);

    Route::prefix('logs')->name('logs.')->group(function () {
        Route::get('search', [LogController::class, 'search'])->name('search');
    });
    Route::apiResource('logs', LogController::class);
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('search', [RoleController::class, 'search'])->name('search');
    });
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('profiles', ProfileController::class);

    Route::get('/comments/chartline', [CommentController::class, 'chartline'])->name('comments.chartline');

});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('links', LinkController::class)->only(['store']);
    Route::apiResource('deslinks', DesLinkController::class)->only(['store']);
    Route::apiResource('ratings', RatingController::class)->only(['store']);
    Route::get('/ratings/{user}/{post}', [RatingController::class, 'getRating'])->name('ratings.get');
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

Route::get('/viacep/{cep}', [ViaCepController::class, 'getAddressByCep'])->name('viacep.getAddressByCep');
