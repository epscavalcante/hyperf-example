<?php

declare(strict_types=1);

namespace Core\Application\UseCases\Signup;

class SignupInput
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
    ) {}
}
