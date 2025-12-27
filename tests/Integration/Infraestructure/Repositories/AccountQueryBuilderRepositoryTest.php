<?php

use Core\Domain\Entities\Account;
use App\Repositories\AccountQueryBuilderRepository;
use Hyperf\DbConnection\Db;
use Ramsey\Identifier\Ulid\UlidFactory;

afterAll(function () {
    Db::table('accounts')->truncate();
});

describe('AccountQueryBuilderRepositoryTest', function () {
    beforeEach(function () {
        Db::table('accounts')->truncate();
    });

    describe('GetByEmail', function () {
        test('Should return null when not found by email', function () {
            $accountRepository = new AccountQueryBuilderRepository;
            $accountNotFound = $accountRepository->getByEmail('john.doe@email.com');
            expect($accountNotFound)->toBeNull();
        });

        test('Should return account when found by email', function () {
            $accountId = (new UlidFactory)->create();
            $email = 'jane.smith' . uniqid() . '@email.com';
            Db::table('accounts')
                ->insert([
                    'id' => $accountId->toString(),
                    'first_name' => 'Jane',
                    'last_name' => 'Smith',
                    'email' => $email,
                ]);

            $accountRepository = new AccountQueryBuilderRepository;
            $accountFound = $accountRepository->getByEmail($email);
            expect($accountFound)->toBeInstanceOf(Account::class);
            expect($accountFound->getId())->toBe($accountId->toString());
        });
    });
});
