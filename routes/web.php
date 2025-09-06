<?php

use Illuminate\Support\Facades\Route;

Route::permanentRedirect('/', '/documentation');

Route::get('/documentation', function () {

    // Using Redoc for api documentation

    return view('redoc-static');
});
