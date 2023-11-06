<?php

use Modules\Termin\Http\Controllers\API\V1;

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
    Route::apiResource('termins', V1\TerminController::class)
        ->only(['index']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::controller(V1\TerminController::class)->group(function () {
            Route::post('termins/{termin}/restore', 'restore')
                ->name('termins.restore')
                ->withTrashed();
            Route::delete('termins/{termin}/delete', 'forceDelete')
                ->name('termins.delete')
                ->withTrashed();
        });
        Route::apiResource('termins', V1\TerminController::class)
            ->except(['index']);
    });
});
