<?php

return [
    'handler' => [
        'http' => [
            // depois criar uma exception expecifica para retornar todos os erros de validação  e content type corretamente
            \Hyperf\Validation\ValidationExceptionHandler::class,
        ],
    ],
];
