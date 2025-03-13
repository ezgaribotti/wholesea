<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Fluent;

define('PERCENT_SIGN', chr(37));
define('QUESTION_MARK', chr(63));

if (! function_exists('build_path')) {
    function build_path(string ...$segments): string
    {
        return implode(DIRECTORY_SEPARATOR, $segments);
    }
}

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

if (! function_exists('with_like')) {
    function with_like(string $value): string
    {
        return str_pad($value, strlen($value) + 2, PERCENT_SIGN, STR_PAD_BOTH);
    }
}
