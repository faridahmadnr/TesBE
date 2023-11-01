<?php

namespace App\Providers;

use App\Support\NikParser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
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

        Validator::extend('valid_nik', function ($attribute, $value, $parameters, $validator) {
            $nikParser = new NikParser($value);

            return $nikParser->isValid();
        });
    }
}
