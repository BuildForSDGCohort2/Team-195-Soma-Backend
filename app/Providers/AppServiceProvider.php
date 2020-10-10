<?php

namespace App\Providers;

//use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    $this->registerPolicies();
    Passport::routes();

    Passport::tokensExpireIn(now()->addDays(7));

    Passport::refreshTokensExpireIn(now()->addDays(7));

    Passport::personalAccessTokensExpireIn(now()->addDays(7));
    }
}
