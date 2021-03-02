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
Route::get('/rider/signup', [HomeController::class, 'riderFormReg']);
Route::post('/rider/submit/signup', [HomeController::class, 'riderFormSubmit'])->name('register.rider');

// End of public links

Auth::routes();
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('/p', 'UserController');
    Route::post('/r/i', [UserController::class, 'getDetailById'])->name('user.get.detail');
    Route::post('/u/p', [UserController::class, 'profilePicUpload'])->name('profile.pic.upload');
    Route::post('/g/i', [UserController::class, 'govIdUpload'])->name('gov.id.upload');
    Route::get('/u/cp/f', [UserController::class, 'changePasswordForm'])->name('profile.cpass');
    Route::post('/u/c/p', [UserController::class, 'CPSubmit'])->name('profile.change.pass');
    Route::get('/r/p/{id}', [UserController::class, 'resetPass'])->name('profile.reset.pass');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::get('/settings/set/payment', [SettingsController::class, 'payment_type'])->name('settings.blade.php');
});

Route::post('/notif', function (\Illuminate\Http\Request $request) {
    $message = [];
    if (Session::has('success')) {
        $message = ['message'=> Session::get('success'), 'status' => 'success'];
        session()->forget('success');
    }
    if (Session::has('error')) {
        $message = ['message'=> Session::get('error'), 'status' => 'error'];
        session()->forget('error');
    }
    if (Session::has('warning')) {
        $message = ['message'=> Session::get('warning'), 'status' => 'warning'];
        session()->forget('error');
    }
    if ($request->errors) {
        $message = ['message'=> Session::get('errors'), 'status' => 'errors'];
        session()->forget('error');
    }

    return $message;
})->name('notif');
