<?php

use App\Providers\ModuleServiceProvider as Module;
use Illuminate\Support\Facades\Route;
use Modules\Common\src\Http\Middleware\EnsurePaymentProcessable;
use Modules\Shipments\src\Http\Controllers\CargoManifestController;
use Modules\Shipments\src\Http\Controllers\InsurancePolicyController;
use Modules\Shipments\src\Http\Controllers\LogisticsPointController;
use Modules\Shipments\src\Http\Controllers\ProcessPaymentController;
use Modules\Shipments\src\Http\Controllers\ShipmentController;
use Modules\Shipments\src\Http\Controllers\ShippingCostController;
use Modules\Shipments\src\Http\Controllers\TaxController;
use Modules\Shipments\src\Http\Controllers\TrackingStatusController;
use Modules\Shipments\src\Http\Controllers\TransportTypeController;

Module::defineRoutes(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/tracking-statuses', [TrackingStatusController::class, 'index'])->name('tracking-statuses.index');
        Route::get('/transport-types', [TransportTypeController::class, 'index'])->name('transport-types.index');
        Route::apiResource('taxes', TaxController::class)->only(['index']);
        Route::apiResource('cargo-manifests', CargoManifestController::class)->only(['index']);
        Route::apiResource('insurance-policies', InsurancePolicyController::class)->only(['index']);
        Route::apiResource('logistics-points', LogisticsPointController::class)->only(['index']);
        Route::apiResource('shipments', ShipmentController::class)->except(['destroy']);
        Route::prefix('shipping-cost')
            ->name('shipping-cost.')
            ->controller(ShippingCostController::class)->group(function () {
                Route::post('/calculate', 'calculate')->name('calculate');
            });
    });
});

Route::prefix('shipment-payments')
    ->name('shipments.shipment-payments.')
    ->middleware([EnsurePaymentProcessable::class])
    ->controller(ProcessPaymentController::class)->group(function () {
        Route::get('/success', 'success')->name('success');
        Route::get('/cancel', 'cancel')->name('cancel');
    });
