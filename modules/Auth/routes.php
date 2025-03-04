<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\src\Http\Controllers\AuthController;
use Modules\Auth\src\Http\Controllers\OperatorController;
use Modules\Auth\src\Http\Controllers\PermissionController;

api_routes(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('operators', OperatorController::class);

        Route::controller(PermissionController::class)->group(function () {
            Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
        });
        Route::controller(AuthController::class)->group(function () {
            Route::post('/logout', 'logout')->name('logout');
            Route::get('/current-operator', 'currentOperator')->name('current-operator');
        });
    });
});
