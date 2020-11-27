<?php

use App\Http\Controllers\TopUpController;

Route::get('/topup', [TopUpController::class, 'index'])->name('topup.requests');
Route::post('/topup/table', [TopUpController::class, 'table'])->name('topup.table');
