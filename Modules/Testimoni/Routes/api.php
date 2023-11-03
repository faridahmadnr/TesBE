<?php

use Modules\Testimoni\Http\Controllers\API\V1;

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

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function () {
        Route::controller(V1\TestimoniController::class)->group(function () {
            Route::post('testimonials/{testimonial}/restore', 'restore')
                ->name('testimonials.restore')
                ->withTrashed();
            Route::delete('testimonials/{testimonial}/delete', 'forceDelete')
                ->name('testimonials.delete')
                ->withTrashed();
        });
        Route::apiResource('testimonials', V1\TestimoniController::class);
    });
});
