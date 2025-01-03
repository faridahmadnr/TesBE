<?php

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

Route::group(['prefix' => 'v1/reports', 'as' => 'api.v1.reports.'], function () {
    Route::get('/public', V1\PublicReportController::class);

    Route::get('regencies/chart', V1\RegencyDistributionController::class);
    Route::get('submission-status', V1\SubmissionStatusController::class);
    Route::group(['middleware' => 'auth:sanctum'], function () {

        Route::controller(V1\RegencyReportController::class)->group(function () {
            Route::post('regencies/{regencyReport}/restore', 'restore')
                ->name('regencies.restore')
                ->withTrashed();
            Route::delete('regencies/{regencyReport}/delete', 'forceDelete')
                ->name('regencies.delete')
                ->withTrashed();
        });
        Route::apiResource('regencies', V1\RegencyReportController::class)
            ->except(['index']);

        Route::controller(V1\SectorReportController::class)->group(function () {
            Route::post('sector-reports/{sectorReport}/restore', 'restore')
                ->name('sector-reports.restore')
                ->withTrashed();
            Route::delete('sector-reports/{sectorReport}/delete', 'forceDelete')
                ->name('sector-reports.delete')
                ->withTrashed();
        });
        // Route::get('reports/bank-distribution/chart', [V1\BankDistributionController::class, 'chart']);
        Route::get('bank-distribution', [V1\BankDistributionController::class, 'table']);
        Route::get('bank-distribution/chart', [V1\BankDistributionController::class, 'chart']);
        // Route::get('sectors/distribution', V1\SectorLendingDistributionController::class);
        Route::get('sectors/chart', V1\DebtorSectorDistributionController::class);

        Route::apiResource('sectors', V1\SectorReportController::class)
            ->except(['index']);

        Route::group(['prefix' => 'external', 'as' => 'external.'], function () {
            Route::apiResource('sector-distribution', V1\External\ExternalSectorDistributionController::class)
                ->parameters([
                    'sector-distribution' => 'sectorReport',
                ]);
            Route::controller(V1\External\ExternalSectorDistributionController::class)->group(function () {
                Route::post('sector-distribution/{sectorReport}/restore', 'restore')
                    ->name('sector-distribution.restore')
                    ->withTrashed();
                Route::delete('sector-distribution/{sectorReport}/delete', 'forceDelete')
                    ->name('sector-distribution.delete')
                    ->withTrashed();
            });

            Route::apiResource('region-distribution', V1\External\ExternalRegencyDistributionController::class)
                ->parameters([
                    'region-distribution' => 'regionReport',
                ]);
            Route::controller(V1\External\ExternalRegencyDistributionController::class)->group(function () {
                Route::post('region-distribution/{regionReport}/restore', 'restore')
                    ->name('region-distribution.restore')
                    ->withTrashed();
                Route::delete('region-distribution/{regionReport}/delete', 'forceDelete')
                    ->name('region-distribution.delete')
                    ->withTrashed();
            });

            Route::apiResource('sector-distribution-5-years', V1\External\ExternalQuinquennialDistributionController::class)
                ->parameters([
                    'sector-distribution-5-years' => 'sectorReport',
                ]);
            Route::controller(V1\External\ExternalQuinquennialDistributionController::class)->group(function () {
                Route::post('sector-distribution-5-years/{sectorReport}/restore', 'restore')
                    ->name('sector-distribution-5-years.restore')
                    ->withTrashed();
                Route::delete('sector-distribution-5-years/{sectorReport}/delete', 'forceDelete')
                    ->name('sector-distribution-5-years.delete')
                    ->withTrashed();
            });

            Route::apiResource('achivement-realization', V1\External\ExternalAchivementController::class)
                ->parameters([
                    'achivement-realization' => 'achivementRealization',
                ]);
            Route::controller(V1\External\ExternalAchivementController::class)->group(function () {
                Route::post('achivement-realization/{achivementRealization}/restore', 'restore')
                    ->name('achivement-realization.restore')
                    ->withTrashed();
                Route::delete('achivement-realization/{achivementRealization}/delete', 'forceDelete')
                    ->name('achivement-realization.delete')
                    ->withTrashed();
            });
        });
    });
    // REGION REPORTS
    Route::apiResource('regencies', V1\RegencyReportController::class)
        ->only(['index']);
    // SECTOR REPORTS
    Route::apiResource('sectors', V1\SectorReportController::class)
        ->only(['index']);
});
