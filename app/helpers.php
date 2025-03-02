<?php

if (! function_exists('build_path')) {
    function build_path(string ...$segments): string
    {
        return implode(DIRECTORY_SEPARATOR, $segments);
    }
}
