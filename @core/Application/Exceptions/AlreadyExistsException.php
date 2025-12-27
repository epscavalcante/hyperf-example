<?php

declare(strict_types=1);

namespace Core\Application\Exceptions;

use Exception;

class AlreadyExistsException extends Exception
{
    public function __construct(string $message = 'Already exits')
    {
        parent::__construct($message);
    }
}
