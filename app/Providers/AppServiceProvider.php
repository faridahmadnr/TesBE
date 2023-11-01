<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

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
        Model::preventLazyLoading(! app()->isProduction());
        Sanctum::$accessTokenAuthenticationCallback = function ($accessToken, $isValid) {
            return ! $accessToken->last_used_at || $accessToken->last_used_at->gte(now()->subHours(72));
        };
    }
}
