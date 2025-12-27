<?php

declare(strict_types=1);

namespace App\Repositories;

use Core\Application\Repositories\AccountRepositoryInterface;
use Core\Domain\Entities\Account;
use App\Model\AccountModel;

class AccountModelRepository implements AccountRepositoryInterface
{
    public function getByEmail(string $email): ?Account
    {
        $account = AccountModel::query()->where('email', $email)->first();

        if (is_null($account)) {
            return null;
        }

        return Account::restore(
            accountId: $account->id,
            firstName: $account->first_name,
            lastName: $account->last_name,
            email: $account->email,
        );
    }

    public function getById(string $accountId): ?Account
    {
        $account = AccountModel::query()->find($accountId);

        if (is_null($account)) {
            return null;
        }

        return Account::restore(
            accountId: $account->id,
            firstName: $account->first_name,
            lastName: $account->last_name,
            email: $account->email,
        );
    }

    public function save(Account $account): void
    {
        AccountModel::query()
            ->create([
                'id' => $account->getId(),
                'first_name' => $account->getFirstName(),
                'last_name' => $account->getLastName(),
                'email' => $account->getEmail(),
            ]);
    }
}
