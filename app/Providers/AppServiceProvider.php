<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\CategoryType;
use App\Models\IndicativeRating;
use App\Models\Plan;
use App\Models\PostImage;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;
use \App\Services\MaskService;

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
        Route::model('log', Activity::class);
        Route::model('role', Role::class);
        Route::model('permisso', Role::class);
        $maskService = new MaskService();

        view()->composer('*', function($view) use ($maskService) {
            $user = auth()->user();
            $roles = ['Admin', 'Membros', 'Root', 'Client'];

            $settings = Setting::select('name', 'body')->whereIn('group', [
                'company',
                'address',
                'site'
            ])->get();
            
            $name = $settings->where('name', 'name')->first()?->body ?? 'Minha Empresa';
            $description = $settings->where('name', 'description')->first()?->body ?? '';
            $cnpj = $settings->where('name', 'cnpj')->first()?->body ?? '00.000.000/0000-00';
            $cnpj = $maskService->applyMask($cnpj, '##.###.###/####-##');
            $email = $settings->where('name', 'email')->first()?->body ?? '';
            $logo = asset('site/img/logo-sce.jpeg');
            $scripts = asset('js/script.js');
            $phone = $settings->where('name', 'phone')->first()?->body ?? '31999999999';
            $phone = $maskService->applyMask($phone, '(##) #####-####');
            $cep = $settings->where('name', 'cep')->first()?->body ?? '00000-000';
            $steet = $settings->where('name', 'street')->first()?->body ?? '';
            $number = $settings->where('name', 'number')->first()?->body ?? '';
            $neighborhood = $settings->where('name', 'neighborhood')->first()?->body ?? '';
            $city = $settings->where('name', 'city')->first()?->body ?? '';
            $state = $settings->where('name', 'state')->first()?->body ?? '';

            $streets = collect([$steet, $number, $neighborhood, $city, $cep, $state])->filter()->implode(', ');
            
            if ($user) {
                $user->load('roles');
            }

            $view->with('user', $user);
            $view->with('isRole', $user ? $user->hasAnyRole($roles) : false);
            $view->with('companyName', $name);
            $view->with('companyDescription', $description);
            $view->with('companyCNPJ', $cnpj);
            $view->with('companyEmail', $email);
            $view->with('companyLogo', $logo);
            $view->with('companyAddress', $streets);
            $view->with('companyScripts', $scripts);
            $view->with('companyPhone', $phone);
        });
    }
}
