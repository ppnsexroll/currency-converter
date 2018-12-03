<?php
return [
    'settings' => [
        'displayErrorDetails' => getenv('PHP_ENV') !== 'production',
        'addContentLengthHeader' => false,
        'logger' => [
            'name' => 'slim-app',
            'path' => getenv('docker') ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
