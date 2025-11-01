<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

#[Controller()]
class HelloController
{
    #[RequestMapping(path: '/hello', methods: 'GET')]
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return $response->json([
            'method' => $request->getMethod(),
            'message' => 'Hello',
        ]);
    }
}
