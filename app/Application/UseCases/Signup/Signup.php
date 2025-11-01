<?php

declare(strict_types=1);

namespace App\Application\UseCases\Signup;

use Psr\Log\LoggerInterface;

class Signup
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {}

    public function execute(SignupInput $input): SignupOutput
    {
        $this->logger->info(__METHOD__);
        $this->logger->debug('Signup input', (array) $input);
        // Business logic to create a new user account would go here.

        // For demonstration purposes, we'll return a dummy account ID.
        $accountId = uniqid('account_', true);

        return new SignupOutput($accountId);
    }
}
