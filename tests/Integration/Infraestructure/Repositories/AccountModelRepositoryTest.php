<?php

use Core\Domain\Entities\Account;
use App\Repositories\AccountModelRepository;
use Hyperf\DbConnection\Db;
use Ramsey\Identifier\Ulid\UlidFactory;

afterAll(function () {
    Db::table('accounts')->truncate();
});

describe('AccountModelRepositoryTest', function () {
    beforeEach(function () {
        Db::table('accounts')->truncate();
    });

    describe('GetByEmail', function () {
        test('Should return null when not found by email', function () {
            $accountRepository = new AccountModelRepository;
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

            $accountRepository = new AccountModelRepository;
            $accountFound = $accountRepository->getByEmail($email);
            expect($accountFound)->toBeInstanceOf(Account::class);
            expect($accountFound->getId())->toBe($accountId->toString());
        });
    });

    describe('GetById', function () {
        test('Should return null when not found by id', function () {
            $accountRepository = new AccountModelRepository;
            $accountNotFound = $accountRepository->getById('non-existent-id');
            expect($accountNotFound)->toBeNull();
        });

        test('Should return account when found by id', function () {
            $accountId = (new UlidFactory)->create();
            $email = 'jane.smith' . uniqid() . '@email.com';
            Db::table('accounts')
                ->insert([
                    'id' => $accountId->toString(),
                    'first_name' => 'Jane',
                    'last_name' => 'Smith',
                    'email' => $email,
                ]);

            $accountRepository = new AccountModelRepository;
            $accountFound = $accountRepository->getById($accountId->toString());
            expect($accountFound)->toBeInstanceOf(Account::class);
            expect($accountFound->getId())->toBe($accountId->toString());
        });
    });

    describe('Save', function () {
        test('Should save an account', function () {
            $account = Account::create(
                firstName: 'John',
                lastName: 'Doe',
                email: 'john.doe' . uniqid() . '@email.com',
            );

            $accountRepository = new AccountModelRepository;
            $accountRepository->save($account);
            $accountFound = $accountRepository->getById($account->getId());
            expect($accountFound)->toBeInstanceOf(Account::class);
            expect($accountFound->getId())->toBe($account->getId());
        });
    });
});
