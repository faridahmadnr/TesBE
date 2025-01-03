<?php

use Modules\Requirement\Http\Controllers\API\V1;

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
    Route::apiResource('requirements', V1\RequirementController::class)
        ->only(['index']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::controller(V1\RequirementController::class)->group(function () {
            Route::post('requirements/{requirement}/restore', 'restore')
                ->name('requirements.restore')
                ->withTrashed();
            Route::delete('requirements/{requirement}/delete', 'forceDelete')
                ->name('requirements.delete')
                ->withTrashed();
        });
        Route::apiResource('requirements', V1\RequirementController::class)
            ->except(['index']);
    });
});
