<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::middleware(['auth'])->group(function () {
    Route::get('/b', [BookingController::class, 'index'])->name('booking');
    Route::post('/d/s', [BookingController::class, 'store'])->name('booking.submit');
    Route::get('/m/m', [BookingController::class, 'map'])->name('booking.map');
    Route::post('/b/s', [BookingController::class, 'locationStore'])->name('booking.location.store');
    Route::post('/b/m', [BookingController::class, 'matrix'])->name('booking.matrix');
});
