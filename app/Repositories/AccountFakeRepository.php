<?php

declare(strict_types=1);

namespace App\Repositories;

use Core\Application\Repositories\AccountRepositoryInterface;
use Core\Domain\Entities\Account;

class AccountFakeRepository implements AccountRepositoryInterface
{
    /**
     * @var Account[]
     */
    private array $accounts = [];

    public function getByEmail(string $email): ?Account
    {
        $accountCount = count($this->accounts);
        if ($accountCount === 0) {
            return null;
        }
        foreach ($this->accounts as $account) {
            if ($account->getEmail() === $email) {
                return $account;
            }
        }

        return null;
    }

    public function getById(string $accountId): ?Account
    {
        $accountCount = count($this->accounts);
        if ($accountCount === 0) {
            return null;
        }
        foreach ($this->accounts as $account) {
            if ($account->getId() === $accountId) {
                return $account;
            }
        }

        return null;
    }

    public function save(Account $account): void
    {
        array_push($this->accounts, $account);
    }
}
