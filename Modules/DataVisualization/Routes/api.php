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

    // section 2

    // section 3 (data chart)
    Route::get('kur-bank-distribution', [V1\BankDistributionController::class, 'index']);

    // section 4

    // section 5

});
