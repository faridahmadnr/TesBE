<?php

use App\Http\Controllers\DownloadController;
use App\Mail\DailyBackupDatabaseMail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // $user = User::first();

    // return (new VerifyEmailNotification($user))->toMail($user);
    return new DailyBackupDatabaseMail;
    abort(403);
});

Route::get('/download/{code}', DownloadController::class)->name('download');
