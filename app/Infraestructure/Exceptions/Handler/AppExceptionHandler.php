<?php

declare(strict_types=1);

namespace App\Infraestructure\Exceptions\Handler;

use App\Application\Exceptions\AlreadyExistsException;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Throwable;

class AppExceptionHandler extends ExceptionHandler
{
    public function __construct(protected LoggerInterface $logger) {}

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->logger->error(sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));
        $this->logger->error($throwable->getTraceAsString());

        if ($throwable instanceof AlreadyExistsException) {

            $this->stopPropagation();

            $data = json_encode([
                'message' => $throwable->getMessage(),
            ], JSON_UNESCAPED_UNICODE);

            return $response->withStatus(409)->withBody(new SwooleStream($data));
        }

        return $response->withHeader('Server', 'Hyperf')
            ->withStatus(500)
            ->withBody(new SwooleStream('Internal Server Error.'));
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
