<?php

use Illuminate\Http\Request;
use Modules\Report\Http\Controllers\API\V1;

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

// SECTOR REPORTS
Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function () {
    Route::apiResource('sector-reports', V1\SectorReportController::class)
        ->only(['index']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::controller(V1\SectorReportController::class)->group(function () {
            Route::post('sector-reports/{sectorReport}/restore', 'restore')
                ->name('sector-reports.restore')
                ->withTrashed();
            Route::delete('sector-reports/{sectorReport}/delete', 'forceDelete')
                ->name('sector-reports.delete')
                ->withTrashed();
        });
        Route::apiResource('sector-reports', V1\SectorReportController::class)
            ->except(['index']);
    });
});

// REGION REPORTS
