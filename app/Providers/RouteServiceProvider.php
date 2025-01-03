<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        Route::macro('apiRoutes', function (string $routeName, $controller) {
            Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function () use ($routeName, $controller) {
                $namedRoute = str_replace('/', '.', $routeName);
                $parameter = Str::singular(Str::camel($namedRoute));

                Route::apiResource($routeName, $controller)
                    ->only(['index', 'show'])
                    ->names([
                        'index' => "{$namedRoute}.index",
                        'show' => "{$namedRoute}.show",
                    ])
                    ->parameters([
                        $namedRoute => $parameter,
                    ]);

                Route::group(['middleware' => 'auth:sanctum'], function () use ($routeName, $controller, $namedRoute, $parameter) {

                    Route::controller($controller)->group(function () use ($routeName, $namedRoute) {
                        $routePathname = Str::contains($routeName, '/') ? Str::after($routeName, '/') : $routeName;
                        $routeSingular = Str::singular(Str::camel($routePathname));

                        Route::post("{$routeName}/{{$routeSingular}}/restore", 'restore')
                            ->name($namedRoute.'.restore')
                            ->withTrashed();
                        Route::delete("{$routeName}/{{$routeSingular}}/delete", 'forceDelete')
                            ->name($namedRoute.'.delete')
                            ->withTrashed();
                    });
                    Route::apiResource($routeName, $controller)
                        ->except(['index', 'show'])
                        ->names([
                            'store' => "{$namedRoute}.store",
                            'update' => "{$namedRoute}.update",
                            'destroy' => "{$namedRoute}.destroy",
                        ])
                        ->parameters([
                            $namedRoute => $parameter,
                        ]);
                });
            });
        });
    }
}
