<?php

use Modules\BusinessType\Http\Controllers\API\V1\BusinessTypeController;

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
        Route::apiResource('business-types', BusinessTypeController::class)
            ->parameters([
                'business-types' => 'businessType',
            ]);
    });
});
