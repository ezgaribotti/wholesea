<?php

use Illuminate\Support\Facades\Route;
use Modules\Orders\src\Http\Controllers\OrderController;
use Modules\Orders\src\Http\Controllers\ProcessPaymentController;

api_routes(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('orders', OrderController::class)->except(['destroy']);
    });
});

Route::prefix('order-payments')
    ->name('order-payments.')
    ->controller(ProcessPaymentController::class)->group(function () {
        Route::get('/success', 'success')->name('success');
        Route::get('/cancel', 'cancel')->name('cancel');
    });
