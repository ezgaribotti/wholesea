<?php

use Illuminate\Support\Fluent;

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
