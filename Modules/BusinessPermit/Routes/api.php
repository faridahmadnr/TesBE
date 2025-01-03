<?php

use Modules\BusinessPermit\Http\Controllers\API\V1;

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
    Route::apiResource('business-permits', V1\BusinessPermitController::class)
        ->parameters([
            'business-permits' => 'businessPermit',
        ])
        ->only(['index']);
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::controller(V1\BusinessPermitController::class)->group(function () {
            Route::post('business-permits/{businessPermit}/restore', 'restore')
                ->name('business-permits.restore')
                ->withTrashed();
            Route::delete('business-permits/{businessPermit}/delete', 'forceDelete')
                ->name('business-permits.delete')
                ->withTrashed();
        });
        Route::apiResource('business-permits', V1\BusinessPermitController::class)
            ->parameters([
                'business-permits' => 'businessPermit',
            ])
            ->except(['index']);
    });
});
