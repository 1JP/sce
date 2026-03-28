<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\CategoryType;
use App\Models\IndicativeRating;
use App\Models\Plan;
use App\Models\PostImage;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::model('categoria', Category::class);
        Route::model('tipos_de_categoria', CategoryType::class);
        Route::model('classificacao_indicativa', IndicativeRating::class);
        Route::model('plano', Plan::class);
        Route::model('post_image', PostImage::class);
        Route::model('usuario', User::class);
        Route::model('member', User::class);
        Route::model('membro', User::class);
        Route::model('assinatura', Subscription::class);
        Route::model('pagamento', Subscription::class);
    }
}
