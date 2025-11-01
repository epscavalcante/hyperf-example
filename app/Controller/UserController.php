<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\StoreUserRequest;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

#[Controller(prefix: '/users')]
class UserController
{
    #[GetMapping(path: '')]
    public function list(RequestInterface $request, ResponseInterface $response)
    {
        return $response->json([])->withStatus(200);
    }

    #[PostMapping(path: '')]
    public function store(StoreUserRequest $request, ResponseInterface $response)
    {
        $data = $request->validated();

        return $response->json([
            'user_id' => uniqid('USER_'),
        ])->withStatus(201);
    }
}
