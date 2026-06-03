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

    // Form Kit (schémas JSON, builder interactif, viewer) — voir la documentation `/docs/forms/*`.
    'forms' => [
        'jsonata' => [
            'evaluator' => null,
            'function_catalog' => [],
            'engine_version' => '2.1.0',
            'max_expression_length' => 5000,
            'max_expression_count' => 100,
            'timeout' => 5,
        ],
    ],
];
