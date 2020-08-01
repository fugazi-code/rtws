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
use App\Http\Controllers\AccountsController;

Auth::routes();
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('/', 'UserController');
    Route::post('/u/p', [UserController::class, 'profilePicUpload'])->name('profile.pic.upload');

    Route::get('/posting', [CustomerController::class, 'postForm'])->name('posting');
    Route::post('/posting/submit', [CustomerController::class, 'postSubmit'])->name('posting.submit');

    Route::get('/orders', [CustomerController::class, 'myOrders'])->name('orders');
    Route::post('/orders/fetch', [CustomerController::class, 'fetchOrders'])->name('orders.fetch');

    Route::get('/posted', [RiderController::class, 'postedOrders'])->name('posted');
    Route::post('/posted/fetch', [RiderController::class, 'fetchPosted'])->name('posted.fetch');

    Route::get('/accounts', [AccountsController::class, 'index'])->name('accounts');
    Route::post('/accounts/fetch', [AccountsController::class, 'fetch'])->name('accounts.fetch');
    Route::get('/accounts/signup', [AccountsController::class, 'signup'])->name('accounts.signup');
    Route::post('/accounts/submit', [AccountsController::class, 'store'])->name('accounts.signup.submit');
    Route::get('/accounts/edit/{id}', [AccountsController::class, 'edit'])->name('accounts.edit');
    Route::post('/accounts/update/{id}', [AccountsController::class, 'update'])->name('accounts.update');
    Route::get('/accounts/delete/{id}', [AccountsController::class, 'destroy'])->name('accounts.delete');

});
