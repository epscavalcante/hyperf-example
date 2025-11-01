<?php

use App\Application\UseCases\Signup\Signup;
use App\Application\UseCases\Signup\SignupInput;
use App\Application\UseCases\Signup\SignupOutput;
use Psr\Log\LoggerInterface;

describe('Signup Test', function () {
    test('Should create a new user account', function () {
        $signupInput = new SignupInput(
            name: 'John Doe',
            email: 'john.doe@email.com'
        );

        $logger = Mockery::mock(LoggerInterface::class);
        $logger->shouldReceive('info');
        $logger->shouldReceive('debug');
        // $logger = $this->getContainer()->get(LoggerInterface::class);

        $signup = new Signup(
            logger: $logger
        );

        $signupOutput = $signup->execute($signupInput);

        expect($signupOutput)->toBeInstanceOf(SignupOutput::class);
        expect($signupOutput->accountId)->toBeString();
    });
});
