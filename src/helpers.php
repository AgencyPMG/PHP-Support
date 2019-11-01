<?php declare(strict_types=1);

if (!function_exists('dd')) {
    // Make the dd() function available for Laravel converts.
    function dd(...$params) {
        dump($params);
        exit;
    }
}

if (!function_exists('d')) {
    // Make the dd() function available for Laravel converts.
    function d(...$params) {
        dump($params);
    }
}
