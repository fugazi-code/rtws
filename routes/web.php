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

Auth::routes();
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('/', 'UserController');

    Route::get('/posting', [CustomerController::class, 'postForm'])->name('posting');
    Route::post('/posting/submit', [CustomerController::class, 'postSubmit'])->name('posting.submit');

    Route::get('/orders', [CustomerController::class, 'myOrders'])->name('orders');
    Route::post('/orders/fetch', [CustomerController::class, 'fetchOrders'])->name('orders.fetch');
});
