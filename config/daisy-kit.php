<?php

return [
    'auto_assets' => true,
    'use_vite' => true,
    'vite_build_directory' => 'vendor/art35rennes/laravel-daisy-kit',
    'bundle' => [
        'css' => 'vendor/daisy-kit/daisy-kit.css',
        'js' => 'vendor/daisy-kit/daisy-kit.js',
    ],
    'icon_prefix' => 'bi',
    'docs' => [
        'enabled' => true,
        'prefix' => 'docs',
    ],
    'dev' => [
        'show_theme_selector' => true,
    ],
];
