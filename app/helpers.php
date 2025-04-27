<?php

use Illuminate\Support\Fluent;

if (! function_exists('to_object')) {
    function to_object(array $attributes = []): object
    {
        return new Fluent($attributes);
    }
}

if (! function_exists('create_prefix')) {
    function create_prefix(string $path): string
    {
        return substr($path, 4, ceil(strlen($path) / -3)) . chr(95);
    }
}
