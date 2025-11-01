<?php

declare(strict_types=1);

namespace App\Application\Repositories;

use App\Domain\Entities\Account;

interface AccountRepositoryInterface
{
    public function getByEmail(string $email): ?Account;

    public function getById(string $accountId): ?Account;

    public function save(Account $account): void;
}
