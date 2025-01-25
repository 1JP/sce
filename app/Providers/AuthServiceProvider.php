<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * O mapeamento de políticas para o aplicativo.
     *
     * @var array
     */
    protected $policies = [
        //
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
