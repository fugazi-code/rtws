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
// Para siyang require_once() or include() na function, tawag dito autoloading.
// Need siyang initialize para mabasa
use \App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use \App\Http\Controllers\RiderController;
use \App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\HomeController;

// Eto public links
//<Route class>::<method>(<link style>, [Class sa Http, function sa Class]); Pattern
  Route::get('/', [HomeController::class, 'index']);

// End of public links

Auth::routes();
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('/p', 'UserController');
    Route::post('/u/p', [UserController::class, 'profilePicUpload'])->name('profile.pic.upload');
    Route::get('/u/cp/f', [UserController::class, 'changePasswordForm'])->name('profile.cpass');
    Route::post('/u/c/p', [UserController::class, 'CPSubmit'])->name('profile.change.pass');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::get('/settings/set/payment', [SettingsController::class, 'payment_type'])->name('settings.blade.php');
});
