<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Client;
use App\Models\IndicativeRating;
use App\Models\Plan;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\CategoryTypePolicy;
use App\Policies\ClientPolicy;
use App\Policies\IndicativeRatingPolicy;
use App\Policies\LogPolicy;
use App\Policies\PlanPolicy;
use App\Policies\PostPolicy;
use App\Policies\RolesPolicy;
use App\Policies\SettingPolicy;
use App\Policies\SubscriptionPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * O mapeamento de políticas para o aplicativo.
     *
     * @var array
     */
    protected $policies = [
        IndicativeRating::class => IndicativeRatingPolicy::class,
        Category::class => CategoryPolicy::class,
        CategoryType::class => CategoryTypePolicy::class,
        User::class => UserPolicy::class,
        Plan::class => PlanPolicy::class,
        Post::class => PostPolicy::class,
        Subscription::class => SubscriptionPolicy::class,
        Client::class => ClientPolicy::class,
        Setting::class => SettingPolicy::class,
        Role::class => RolesPolicy::class,
        Activity::class => LogPolicy::class,
    ];

    /**
     * Registre quaisquer serviços de autenticação e autorização.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
