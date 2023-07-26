<?php

use Monolog\Handler\StreamHandler;

return [
    'default'      => env('LOG_CHANNEL', 'stack'),
    'channels' => [

        'stack' => [
            'driver'            => 'stack',
            'channels'          => ['single'],
            'ignore_exceptions' => false,
        ],

        'single' => [
            'driver' => 'single',
            'path'   => storage_path('logs/laravel.log'),
            'level'  => env('LOG_LEVEL', 'debug'),
            'replace_placeholders' => true,
        ],

        'daily' => [
            'driver' => 'daily',
            'tap'    => [\App\Logging\CustomizeFormatter::class],
            'path'   => storage_path('logs/koz-vue-sample.log'),
            'level'  => env('LOG_LEVEL', 'debug'),
            'days'   => 14,
        ],

        'local' => [
            'driver'   => 'stack',
            'channels' => (function () {
                return app()->runningInConsole() ? ['daily'] : ['stdout','daily'];
            })(),
            'ignore_exceptions' => false,
        ],

        'ecs' => [
            'driver'   => 'stack',
            'channels' => ['stdout'],
        ],

        'stderr' => [
            'driver'    => 'monolog',
            'level'     => env('LOG_LEVEL', 'debug'),
            'handler'   => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'with'      => ['stream' => 'php://stderr',]
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level'  => env('LOG_LEVEL', 'debug'),
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level'  => env('LOG_LEVEL', 'debug'),
            'replace_placeholders' => true,
        ],
        'stdout' => [
            'driver'  => 'monolog',
            'tap'     => [\App\Logging\CustomizeFormatter::class],
            'handler' => StreamHandler::class,
            'level'   => env('LOG_LEVEL', 'debug'),
            'with'    => [
                'stream' => 'php://stdout',
            ],
        ],
    ]
];
