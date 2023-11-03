<?php

use Modules\Location\Http\Controllers\API\V1;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function () {
        /**
         * Province
         */
        Route::controller(V1\ProvinceController::class)->group(function () {
            Route::post('provinces/{province}/restore', 'restore')
                ->name('provinces.restore')
                ->withTrashed();
            Route::delete('provinces/{province}/delete', 'forceDelete')
                ->name('provinces.delete')
                ->withTrashed();
        });
        Route::apiResource('provinces', V1\ProvinceController::class);

        /**
         * Regency
         */
        Route::controller(V1\RegencyController::class)->group(function () {
            Route::post('regencies/{regency}/restore', 'restore')
                ->name('regencies.restore')
                ->withTrashed();
            Route::delete('regencies/{regency}/delete', 'forceDelete')
                ->name('regencies.delete')
                ->withTrashed();
        });
        Route::apiResource('regencies', V1\RegencyController::class);

        /**
         * District
         */
        Route::controller(V1\DistrictController::class)->group(function () {
            Route::post('districts/{district}/restore', 'restore')
                ->name('districts.restore')
                ->withTrashed();
            Route::delete('districts/{district}/delete', 'forceDelete')
                ->name('districts.delete')
                ->withTrashed();
        });
        Route::apiResource('districts', V1\DistrictController::class);
    });
});
