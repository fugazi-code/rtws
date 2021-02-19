<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromoCodeController;

Route::middleware(['auth'])->group(function () {
    Route::get('/promo/codes', [PromoCodeController::class, 'index'])->name('promo.codes');
    Route::post('/promo/generate', [PromoCodeController::class, 'generate'])->name('code.generate');
    Route::post('/promo/fetch', [PromoCodeController::class, 'fetch'])->name('code.fetch');
    Route::post('/promo/remove', [PromoCodeController::class, 'remove'])->name('code.remove');
});
