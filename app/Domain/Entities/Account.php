<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Name;
use Ramsey\Identifier\Ulid\Ulid;
use Ramsey\Identifier\Ulid\UlidFactory;

class Account
{
    public function __construct(
        private readonly Ulid $accountId,
        private readonly Name $name,
        private readonly Email $email,
    ) {}

    public static function create(
        string $firstName,
        string $lastName,
        string $email,
    ) {
        $accountId = (new UlidFactory)->create();
        $name = new Name(firstName: $firstName, lastName: $lastName);
        $email = new Email(value: $email);

        return new Account(
            accountId: $accountId,
            email: $email,
            name: $name,
        );
    }

    public static function restore(
        string $accountId,
        string $firstName,
        string $lastName,
        string $email
    ) {
        $accountId = (new UlidFactory)->createFromString($accountId);
        $name = new Name(firstName: $firstName, lastName: $lastName);
        $email = new Email(value: $email);

        return new self(
            accountId: $accountId,
            name: $name,
            email: $email
        );
    }

    public function getId(): string
    {
        return $this->accountId->toString();
    }

    public function getEmail(): string
    {
        return $this->email->getValue();
    }

    public function getFirstName(): string
    {
        return $this->name->getFirstName();
    }

    public function getLastName(): string
    {
        return $this->name->getLastName();
    }

    public function getFullName(): string
    {
        return $this->getFirstName().' '.$this->getLastName();
    }
}
