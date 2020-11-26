<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\RequestStatusController;

Route::middleware(['auth'])->group(function () {
    Route::get('/m/d', [RequestStatusController::class, 'index'])->name('request.status');
    Route::post('/m/d/f', [RequestStatusController::class, 'fetch'])->name('request.fetch');
    Route::post('/m/d/c', [RequestStatusController::class, 'cancel'])->name('request.cancel');
});
