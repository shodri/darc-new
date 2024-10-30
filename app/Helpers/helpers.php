<?php

if (!function_exists('escapeshellarg')) {
    function escapeshellarg($input)
    {
        $input = str_replace('\'', '\\\'', $input);
        return '\'' . $input . '\'';
    }
}