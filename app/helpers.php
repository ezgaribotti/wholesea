<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Fluent;

if (! function_exists('to_object')) {
    function to_object(array $attributes = []): object
    {
        return new Fluent($attributes);
    }
}

if (! function_exists('api_routes')) {
    function api_routes(callable $callback): object
    {
        return Route::middleware('api')->prefix('api')->name('api.')->group($callback);
    }
}

if (! function_exists('wrap_like')) {
    function wrap_like(string $value): string
    {
        return str_pad($value, strlen($value) + 2, chr(37), STR_PAD_BOTH);
    }
}
