<?php

namespace App\Providers;

use App\Support\NikParser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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

        Validator::extend('valid_identity_number', function ($attribute, $value, $parameters, $validator) {
            try {
                $nikParser = new NikParser($value);

                return $nikParser->isValid();
            } catch (\Throwable $th) {
                return false;
            }
        });

        DB::macro('regexp', function ($column, $pattern) {
            $driver = config('database.default');

            if ($driver === 'pgsql') {
                // PostgreSQL uses ~ for regex
                return "$column ~ '$pattern'";
            } else {
                // MySQL/MariaDB uses REGEXP for regex
                return "$column REGEXP '$pattern'";
            }
        });
    }
}
