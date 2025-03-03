<?php

use Illuminate\Support\Facades\Route;
use Modules\Operators\src\Http\Controllers\OperatorController;

api_routes(function () {
    Route::apiResource('operators', OperatorController::class);
});
