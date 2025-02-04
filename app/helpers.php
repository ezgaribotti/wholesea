<?php

use Illuminate\Support\Fluent;

if (! function_exists('pct_between')) {
    function pct_between(string $value): string
    {
        return chr(37).$value.chr(37);
    }
}

if (! function_exists('to_object')) {
    function to_object(array $attributes = []): object
    {
        return new Fluent($attributes);
    }
}
