<?php

use App\Http\Controllers\WalletController;

Route::get('/wallet', [WalletController::class, 'index'])->name('wallet');
Route::post('/wallet/table', [WalletController::class, 'table'])->name('wallet.table');
Route::get('/wallet/top-up', [WalletController::class, 'formTopUp'])->name('wallet.top-up');
Route::post('/wallet/top-up/send', [WalletController::class, 'sendTopUp'])->name('wallet.top-up.send');
