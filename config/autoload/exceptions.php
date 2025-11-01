<?php

declare(strict_types=1);

use Hyperf\HttpServer\Exception\Handler\HttpExceptionHandler;

return [
    'handler' => [
        'http' => [
            HttpExceptionHandler::class,
        ],
    ],
];
