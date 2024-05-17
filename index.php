<?php

@include_once __DIR__ . '/vendor/autoload.php';

use Kirby\Cms\App;

App::plugin('zephir/kirby-openinghours', [
    'fields' => require __DIR__ . '/config/fields.php',
    'blueprints' => [
        'fields/openinghours'           => __DIR__ . '/blueprints/fields/openinghours.yml',
        'fields/openinghoursOverride'   => __DIR__ . '/blueprints/fields/openinghoursOverride.yml',
        'tabs/openinghours'             => __DIR__ . '/blueprints/tabs/openinghours.yml',
        'blocks/openinghours'           => __DIR__ . '/blueprints/blocks/openinghours.yml',
    ],
    'snippets' => [
        'blocks/openinghours'           => __DIR__ . '/snippets/blocks/openinghours.php',
    ]
]);