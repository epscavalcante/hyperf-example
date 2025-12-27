<?php

declare(strict_types=1);

namespace Core\Application\Repositories;

use Core\Domain\Entities\Account;

interface AccountRepositoryInterface
{
    public function getByEmail(string $email): ?Account;

    public function getById(string $accountId): ?Account;

    public function save(Account $account): void;
}
