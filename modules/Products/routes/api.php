<?php

use App\Providers\ModuleServiceProvider as Module;
use Illuminate\Support\Facades\Route;
use Modules\Products\src\Http\Controllers\CategoryController;
use Modules\Products\src\Http\Controllers\ProductController;
use Modules\Products\src\Http\Controllers\ProductImageController;
use Modules\Products\src\Http\Controllers\SupplierController;

Module::defineRoutes(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
        Route::apiResource('products', ProductController::class);
        Route::apiResource('product-images', ProductImageController::class)->only(['store', 'destroy']);
    });
});
