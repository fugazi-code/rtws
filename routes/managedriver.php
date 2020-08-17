<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ManageDriverController;

Route::middleware(['auth'])->group(function () {
    Route::get('/m/d', [ManageDriverController::class, 'index'])->name('manage.driver');
    Route::post('/m/d/f', [ManageDriverController::class, 'fetch'])->name('manage.fetch');
    Route::post('/m/d/c', [ManageDriverController::class, 'cancel'])->name('manage.cancel');
});
