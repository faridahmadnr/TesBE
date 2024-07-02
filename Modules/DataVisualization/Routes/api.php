<?php

use Modules\DataVisualization\Http\Controllers\API\V1;

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

    // section 1
    Route::get('submission-status', [V1\SubmissionStatusController::class, 'index']);

    // section 2
    Route::get('kur-regency-distribution', [V1\RegencyDistributionController::class, 'index']);

    // section 3 (data chart)
    Route::get('kur-bank-distribution', [V1\BankDistributionController::class, 'index']);

    // section 3 (data table)
    Route::get('kur-bank-data', [V1\BankDistributionDataController::class, 'index']);

    // section 4
    Route::get('sector-lending-distribution', [V1\SectorLendingDistributionController::class, 'index']);

    // section 5
    Route::get('debtor-sector-distribution', [V1\DebtorSectorDistributionController::class, 'index']);

});
