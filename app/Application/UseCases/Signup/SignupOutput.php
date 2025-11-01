<?php

declare(strict_types=1);

namespace App\Application\UseCases\Signup;

class SignupOutput
{
    public function __construct(
        public readonly string $accountId,
    ) {}
}
