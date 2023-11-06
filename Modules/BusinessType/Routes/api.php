<?php

use Modules\BusinessType\Http\Controllers\API\V1;

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

Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function () {
    Route::apiResource('business-types', V1\BusinessTypeController::class)
        ->parameters([
            'business-types' => 'businessType',
        ])
        ->only(['index']);
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::controller(V1\BusinessTypeController::class)->group(function () {
            Route::post('business-types/{businessType}/restore', 'restore')
                ->name('business-types.restore')
                ->withTrashed();
            Route::delete('business-types/{businessType}/delete', 'forceDelete')
                ->name('business-types.delete')
                ->withTrashed();
        });
        Route::apiResource('business-types', V1\BusinessTypeController::class)
            ->parameters([
                'business-types' => 'businessType',
            ])
            ->except(['index']);
    });
});
