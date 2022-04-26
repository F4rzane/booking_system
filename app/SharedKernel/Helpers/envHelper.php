<?php

if (! function_exists('is_production')) {
    function is_production(): bool
    {
        return config('app.env') === 'production';
    }
}

if (! function_exists('is_local')) {
    function is_local(): bool
    {
        return config('app.env') === 'local';
    }
}

if (! function_exists('is_debug')) {
    function is_debug(): bool
    {
        return config('app.debug') === true;
    }
}
