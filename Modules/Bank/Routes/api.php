<?php

use Modules\Bank\Http\Controllers\API\V1;

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
    Route::apiResource('banks', V1\BankController::class)
        ->only(['index']);
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function () {
        Route::controller(V1\BankController::class)->group(function () {
            Route::post('banks/{bank}/restore', 'restore')
                ->name('banks.restore')
                ->withTrashed();
            Route::delete('banks/{bank}/delete', 'forceDelete')
                ->name('banks.delete')
                ->withTrashed();
        });
        Route::apiResource('banks', V1\BankController::class)
            ->except(['index']);
    });
});
