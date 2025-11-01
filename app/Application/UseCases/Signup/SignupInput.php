<?php

declare(strict_types=1);

namespace App\Application\UseCases\Signup;

class SignupInput
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
    ) {}
}
