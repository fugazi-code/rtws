<?php

use App\Http\Controllers\WalletController;

Route::get('/wallet', [WalletController::class, 'index'])->name('wallet');
Route::post('/wallet/pay', [WalletController::class, 'pay'])->name('wallet.pay');
Route::get('/wallet/redirect', [WalletController::class, 'redirect'])->name('wallet.redirect');
