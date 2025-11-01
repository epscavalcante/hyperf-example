<?php

use App\Domain\ValueObjects\Name;

describe('Name Tests', function () {
    test('Deve falhar ao criar um nome inválido', function (string $firstName, $lastName) {
        new Name(
            firstName: $firstName,
            lastName: $lastName
        );
    })
        ->throws(Exception::class)
        ->with([
            ['a', 'aa'],
            ['aa', 'a'],
            ['', 'a'],
            [str_repeat('a', 156), str_repeat('a', 100)],
            [str_repeat('a', 100), str_repeat('a', 156)],
        ]);

    test('Deve criar um nome válido', function () {
        $name = new Name('User', 'Test');

        expect($name->getFirstName())->toBe('User');
        expect($name->getLastName())->toBe('Test');
        expect($name->getFullName())->toBe('User Test');
    });
});
