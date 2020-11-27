<?php

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

use \App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use \App\Http\Controllers\RiderController;
use \App\Http\Controllers\UserController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\SettingsController;

Auth::routes();
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('/', 'UserController');
    Route::post('/u/p', [UserController::class, 'profilePicUpload'])->name('profile.pic.upload');
    Route::post('/u/c/p', [UserController::class, 'changePassword'])->name('profile.change.pass');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::get('/settings/set/payment', [SettingsController::class, 'payment_type'])->name('settings.blade.php');
});
