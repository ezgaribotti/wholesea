<?php

use Illuminate\Support\Facades\Route;
use Modules\Orders\src\Http\Controllers\OrderController;
use Modules\Orders\src\Http\Controllers\StripeController;

api_routes(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('orders', OrderController::class)->except(['destroy']);
    });
    Route::prefix('stripe/{tracking_number}')
        ->name('stripe.')
        ->controller(StripeController::class)->group(function () {
            Route::get('/success', 'success')->name('success');
            Route::get('/cancel', 'cancel')->name('cancel');
        });
});
