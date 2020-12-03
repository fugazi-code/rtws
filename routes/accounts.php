<?php
use App\Http\Controllers\AccountsController;

Route::post('/accounts/fetch', [AccountsController::class, 'fetch'])->name('accounts.fetch');
Route::get('/accounts/signup', [AccountsController::class, 'signUp'])->name('accounts.signup');
Route::post('/accounts/submit', [AccountsController::class, 'store'])->name('accounts.signup.submit');
Route::get('/accounts/edit/{id}', [AccountsController::class, 'edit'])->name('accounts.edit');
Route::post('/accounts/update/{id}', [AccountsController::class, 'update'])->name('accounts.update');
Route::get('/accounts/delete/{id}', [AccountsController::class, 'destroy'])->name('accounts.delete');
Route::get('/account/notify', [AccountsController::class, 'notify'])->name('profile.notify');
Route::get('/accounts', [AccountsController::class, 'index'])->name('accounts');
