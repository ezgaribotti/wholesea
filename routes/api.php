<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OperatorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/current-operator', 'currentOperator')->name('current-operator');
        Route::post('/logout', 'logout')->name('logout');
    });
    Route::apiResource('operators', OperatorController::class);
});
