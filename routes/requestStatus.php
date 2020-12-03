<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\RequestStatusController;

Route::middleware(['auth'])->group(function () {
    Route::post('/m/f', [RequestStatusController::class, 'fetch'])->name('request.fetch');
    Route::post('/m/c', [RequestStatusController::class, 'cancel'])->name('request.cancel');
    Route::get('/m/d', [RequestStatusController::class, 'index'])->name('request.status');
});
