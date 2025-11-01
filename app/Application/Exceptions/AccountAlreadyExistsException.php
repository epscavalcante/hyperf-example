<?php

declare(strict_types=1);

namespace App\Application\Exceptions;

class AccountAlreadyExistsException extends AlreadyExistsException
{
    public function __construct()
    {
        parent::__construct('Account already exists');
    }
}
