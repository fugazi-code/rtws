<?php

use App\Http\Controllers\TopUpController;

Route::get('/topup', [TopUpController::class, 'index'])->name('topup.requests');
Route::post('/topup/table', [TopUpController::class, 'table'])->name('topup.table');
Route::get('/topup/edit/{id}', [TopUpController::class, 'edit'])->name('topup.edit');
Route::post('/topup/update', [TopUpController::class, 'update'])->name('topup.update');
