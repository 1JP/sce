<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\CategoryType;
use App\Models\IndicativeRating;
use App\Models\Plan;
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
    }
}
