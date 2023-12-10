<?php

use Modules\News\Http\Controllers\API\V1;

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

Route::apiRoutes('news/categories', V1\NewsCategoryController::class);
Route::apiRoutes('news', V1\NewsController::class);
