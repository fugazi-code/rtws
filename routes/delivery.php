<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\DeliveryController;

Route::middleware(['auth'])->group(function () {
    Route::post('/d/f', [DeliveryController::class, 'fetch'])->name('delivery.fetch');
});
