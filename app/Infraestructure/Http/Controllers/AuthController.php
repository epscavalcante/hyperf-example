<?php

declare(strict_types=1);

namespace App\Infraestructure\Http\Controllers;

use App\Application\UseCases\Signup\Signup;
use App\Application\UseCases\Signup\SignupInput;
use App\Infraestructure\Http\Requests\SignupRequest;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Contract\ResponseInterface;

#[Controller('/auth')]
class AuthController
{
    #[Inject]
    private Signup $signupUseCase;

    #[PostMapping(path: 'signup')]
    public function signup(SignupRequest $request, ResponseInterface $response)
    {
        $input = new SignupInput(
            name: $request->validated()['name'],
            email: $request->validated()['email']
        );
        $output = $this->signupUseCase->execute($input);

        return $response->json([
            'account_id' => $output->accountId,
        ])->withStatus(201);
    }
}
