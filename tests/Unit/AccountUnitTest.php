<?php

declare(strict_types=1);

use App\Domain\Entities\Account;
use Ramsey\Identifier\Ulid\UlidFactory;

describe('Account Unit Tests', function () {
    test('should creates account', function () {
        $account = Account::create(
            firstName: 'John',
            lastName: 'Doe',
            email: 'john.doe@email.com'
        );
        expect($account)->toBeInstanceOf(Account::class);
    });

    test('should restore account', function () {
        $accountId = (new UlidFactory)->create()->toString();
        $account = Account::restore(
            accountId: $accountId,
            firstName: 'John',
            lastName: 'Doe',
            email: 'john.doe@email.com'
        );
        expect($account)->toBeInstanceOf(Account::class);
    });
});
