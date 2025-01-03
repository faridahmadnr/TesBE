<?php

use Modules\Faq\Http\Controllers\API\V1;

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
    Route::apiResource('faqs', V1\FaqController::class)
        ->only(['index']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::apiResource('faqs', V1\FaqController::class)
            ->except(['index']);
    });
});
