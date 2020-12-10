<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\DeliveryController;

Route::middleware(['auth'])->group(function () {
    Route::post('/d/f', [DeliveryController::class, 'fetch'])->name('delivery.fetch');
    Route::get('/d/m/{id}', [DeliveryController::class, 'mine'])->name('delivery.mine');
    Route::get('/d/c/{id}', [DeliveryController::class, 'complete'])->name('delivery.complete');
    Route::get('/d/cc/{id}', [DeliveryController::class, 'cancel'])->name('delivery.cancel');
    Route::get('/d', [DeliveryController::class, 'index'])->name('delivery');
});
