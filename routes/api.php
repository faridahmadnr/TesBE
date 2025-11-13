<?php

use App\Http\Controllers\KurPageSlideController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\KurPageStayController;
use App\Http\Controllers\KurPageEnterController;
use App\Http\Controllers\KurButtonShowController;
use App\Http\Controllers\KurButtonClickController;
use App\Http\Controllers\KurConfirmResultController;
use App\Http\Controllers\KurConfirmValueController;


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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Route untuk API UXTrace
Route::post('/track', [TrackingController::class, 'store']);

// Route::get('coba',function(){
//     return "ok";
// });

Route::get('/kur-page-stay', [KurPageStayController::class, 'index']);
Route::get('/kur-page-slide', [KurPageSlideController::class, 'index']);
Route::get('/kur-page-enter', [KurPageEnterController::class, 'index']);
Route::get('/kur-button-show', [KurButtonShowController::class, 'index']);
Route::get('/kur-button-click', [KurButtonClickController::class, 'index']);
Route::get('/kur-confirm-result', [KurConfirmResultController::class, 'index']);
Route::get('/kur-confirm-value', [KurConfirmValueController::class, 'index']);

//route for button click
//route for confirm level