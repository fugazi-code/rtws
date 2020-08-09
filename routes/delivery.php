<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\DeliveryController;

Route::middleware(['auth'])->group(function () {
    Route::post('/d/f', [DeliveryController::class, 'fetch'])->name('delivery.fetch');
    Route::get('/d/m/{id}', [DeliveryController::class, 'mine'])->name('delivery.mine');
    Route::get('/d/c/{id}', [DeliveryController::class, 'complete'])->name('delivery.complete');
});
