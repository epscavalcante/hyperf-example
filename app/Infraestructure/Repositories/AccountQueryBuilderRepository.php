<?php

declare(strict_types=1);

namespace App\Infraestructure\Repositories;

use App\Application\Repositories\AccountRepositoryInterface;
use App\Domain\Entities\Account;
use Hyperf\DbConnection\Db;

class AccountQueryBuilderRepository implements AccountRepositoryInterface
{
    public function getByEmail(string $email): ?Account
    {
        $account = Db::table('accounts')
            ->where('email', $email)
            ->first();

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
        $account = Db::table('accounts')
            ->where('id', $accountId)
            ->first();

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
        Db::table('accounts')
            ->insert([
                'id' => $account->getId(),
                'first_name' => $account->getFirstName(),
                'last_name' => $account->getLastName(),
                'email' => $account->getEmail(),
            ]);
    }
}
