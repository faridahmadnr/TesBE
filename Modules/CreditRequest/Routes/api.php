<?php

use Modules\CreditRequest\Http\Controllers\API\V1;

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
    Route::apiResource('credit-request-types', V1\CreditRequestTypeController::class)
        ->only(['index']);
    Route::post('credit-requests/simulation', [V1\CreditRequestController::class, 'simulation'])
        ->name('credit-request.simulation');
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function () {
        /**
         * Credit Request Type
         */
        Route::controller(V1\CreditRequestTypeController::class)->group(function () {
            Route::post('credit-request-types/{creditRequestType}/restore', 'restore')
                ->name('credit-request.types.restore')
                ->withTrashed();
            Route::delete('credit-request-types/{creditRequestType}/delete', 'forceDelete')
                ->name('credit-request.types.delete')
                ->withTrashed();
        });
        Route::apiResource('credit-request-types', V1\CreditRequestTypeController::class)
            ->except(['index'])
            ->parameters([
                'credit-request-types' => 'creditRequestType',
            ]);

        /**
         * Credit Request
         */
        Route::controller(V1\CreditRequestController::class)->group(function () {
            Route::post('credit-requests/{creditRequest}/restore', 'restore')
                ->name('credit-request.restore')
                ->withTrashed();
            Route::delete('credit-requests/{creditRequest}/delete', 'forceDelete')
                ->name('credit-request.delete')
                ->withTrashed();
            Route::post('credit-requests/{creditRequest}/confirm', 'confirm')
                ->name('credit-request.confirm');
            Route::post('credit-requests/{creditRequest}/pending', 'pending')
                ->name('credit-request.pending');
            Route::post('credit-requests/{creditRequest}/reject', 'reject')
                ->name('credit-request.reject');
            Route::post('credit-requests/{creditRequest}/approve', 'approve')
                ->name('credit-request.approve');
            Route::post('credit-requests/{creditRequest}/redirect', 'redirect')
                ->name('credit-request.redirect');
            Route::get('credit-requests/{creditRequest}/histories', 'history')
                ->name('credit-request.history');
        });
        Route::apiResource('credit-requests', V1\CreditRequestController::class)
            ->parameters([
                'credit-requests' => 'creditRequest',
            ]);
    });
});
