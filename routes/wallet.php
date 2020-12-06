<?php

use App\Http\Controllers\WalletController;

Route::middleware(['auth'])->group(function () {
    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet');
    Route::post('/wallet/table', [WalletController::class, 'table'])->name('wallet.table');
    Route::get('/wallet/top-up', [WalletController::class, 'formTopUp'])->name('wallet.top-up');
    Route::post('/wallet/send', [WalletController::class, 'sendTopUp'])->name('wallet.top-up.send');
});
