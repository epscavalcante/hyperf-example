<?php

declare(strict_types=1);

namespace App\Application\UseCases\Signup;

use App\Application\Exceptions\AccountAlreadyExistsException;
use App\Application\Repositories\AccountRepositoryInterface;
use App\Domain\Entities\Account;
use Psr\Log\LoggerInterface;

class Signup
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly AccountRepositoryInterface $accountRepository,
    ) {}

    public function execute(SignupInput $input): SignupOutput
    {
        $this->logger->info(__METHOD__);
        $this->logger->debug('Signup input', (array) $input);

        $accountFound = $this->accountRepository->getByEmail($input->email);
        if (! is_null($accountFound)) {
            throw new AccountAlreadyExistsException;
        }

        $names = explode(' ', $input->name);

        $account = Account::create(
            firstName: array_shift($names),
            lastName: implode(' ', $names),
            email: $input->email
        );

        $this->accountRepository->save($account);

        return new SignupOutput($account->getId());
    }
}
