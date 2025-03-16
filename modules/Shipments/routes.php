<?php

use Illuminate\Support\Facades\Route;
use Modules\Shipments\src\Http\Controllers\ProcessPaymentController;
use Modules\Shipments\src\Http\Controllers\ShipmentController;

api_routes(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('shipments', ShipmentController::class)->except(['destroy']);
    });
});

Route::prefix('shipment-payments')
    ->name('shipment-payments.')
    ->controller(ProcessPaymentController::class)->group(function () {
        Route::get('/success', 'success')->name('success');
        Route::get('/cancel', 'cancel')->name('cancel');
    });

