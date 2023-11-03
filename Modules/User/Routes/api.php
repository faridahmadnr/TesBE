<?php

use Modules\User\Http\Controllers\API\V1;

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

Route::group([
    'prefix' => 'v1',
    'as' => 'api.v1.',
], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::post('auth/login', V1\LoginController::class)
            ->name('auth.login');
        Route::post('auth/register', V1\RegisterController::class)
            ->name('auth.register');
        Route::post('auth/forgot-password', V1\ForgotPasswordController::class)
            ->name('auth.forgot-password');
        Route::post('auth/reset-password', V1\NewPasswordController::class)
            ->name('auth.reset-password');
        Route::post('email/verify', V1\VerifyEmailNotificationController::class)
            ->name('auth.verify-email-notification');
        Route::get('auth/verify-email/{id}/{hash}', V1\VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('auth.verify-email');
    });

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::controller(V1\UserController::class)->group(function () {
            Route::post('users/{user}/restore', 'restore')->name('users.restore');
            Route::delete('users/{user}/delete', 'forceDelete')->name('users.delete');
        });
        Route::apiResource('users', V1\UserController::class);

        Route::post('auth/logout', V1\LogoutController::class)
            ->name('auth.logout');

        Route::get('roles', V1\RolesController::class)
            ->name('user.roles');
    });
});
