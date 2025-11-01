<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use Exception;

class Email
{
    private readonly string $value;

    public function __construct(
        string $value,
    ) {
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid e-mail');
        }
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
