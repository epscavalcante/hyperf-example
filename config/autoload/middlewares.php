<?php

return [
    'http' => [
        // Configure your global middleware in the array, the order is based on the order of the array
        \Hyperf\Validation\Middleware\ValidationMiddleware::class
        // Other middleware goes here
    ],
];
