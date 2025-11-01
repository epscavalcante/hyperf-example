<?php

use App\Application\Exceptions\AccountAlreadyExistsException;
use App\Application\Repositories\AccountRepositoryInterface;
use App\Application\UseCases\Signup\Signup;
use App\Application\UseCases\Signup\SignupInput;
use App\Application\UseCases\Signup\SignupOutput;
use App\Domain\Entities\Account;
use Psr\Log\LoggerInterface;

describe('Signup Test', function () {
    test('Should throws AccountAlreadyException', function () {
        $account = Account::create(
            firstName: 'John',
            lastName: 'Smith Doe',
            email: 'john.doe@email.com'
        );
        $signupInput = new SignupInput(
            name: $account->getFullName(),
            email: $account->getEmail()
        );

        $logger = Mockery::mock(LoggerInterface::class);
        $logger->shouldReceive('info')->andReturn();
        $logger->shouldReceive('debug')->andReturn();
        // $logger = $this->getContainer()->get(LoggerInterface::class);

        $accountRepository = Mockery::mock(AccountRepositoryInterface::class);
        $accountRepository->shouldReceive('getByEmail')->andReturn($account);

        $signup = new Signup(
            logger: $logger,
            accountRepository: $accountRepository,
        );

        $signup->execute($signupInput);
    })->throws(AccountAlreadyExistsException::class);

    test('Should create a new user account', function () {
        $signupInput = new SignupInput(
            name: 'John Smith Doe',
            email: 'john.doe@email.com'
        );

        $logger = Mockery::mock(LoggerInterface::class);
        $logger->shouldReceive('info')->andReturn();
        $logger->shouldReceive('debug')->andReturn();
        // $logger = $this->getContainer()->get(LoggerInterface::class);

        $accountRepository = Mockery::mock(AccountRepositoryInterface::class);
        $accountRepository->shouldReceive('getByEmail')->once()->andReturnNull();
        $accountRepository->shouldReceive('save')->once()->andReturn();

        $signup = new Signup(
            logger: $logger,
            accountRepository: $accountRepository,
        );

        $signupOutput = $signup->execute($signupInput);

        expect($signupOutput)->toBeInstanceOf(SignupOutput::class);
        expect($signupOutput->accountId)->toBeString();
    });
});
