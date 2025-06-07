<?php

use App\Providers\ModuleServiceProvider as Module;
use Illuminate\Support\Facades\Route;
use Modules\Shipments\src\Http\Controllers\ProcessPaymentController;
use Modules\Shipments\src\Http\Controllers\ShipmentController;
use Modules\Shipments\src\Http\Controllers\TrackingStatusController;

Module::defineRoutes(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/tracking-statuses', [TrackingStatusController::class, 'index'])->name('tracking-statuses.index');
        Route::apiResource('shipments', ShipmentController::class)->except(['destroy']);
    });
});

Route::prefix('shipment-payments')
    ->name('shipments.shipment-payments.')
    ->controller(ProcessPaymentController::class)->group(function () {
        Route::get('/success', 'success')->name('success');
        Route::get('/cancel', 'cancel')->name('cancel');
    });
