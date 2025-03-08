<?php

use Illuminate\Support\Facades\Route;
use Modules\Products\src\Http\Controllers\CategoryController;
use Modules\Products\src\Http\Controllers\ProductController;
use Modules\Products\src\Http\Controllers\ProductImageController;

api_routes(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/product-images', [ProductImageController::class, 'upload'])->name('product-images.upload');
        Route::apiResource('products', ProductController::class);
    });
});
