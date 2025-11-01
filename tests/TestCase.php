<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 *
 * @document https://hyperf.wiki
 *
 * @contact  group@hyperf.io
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace Tests;

use Hyperf\Testing\Client;
use Hyperf\Testing\TestCase as BaseTestCase;

use function Hyperf\Support\make;

abstract class TestCase extends BaseTestCase
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->client = make(Client::class);
    }

    public function __call($name, $arguments)
    {
        return $this->client->{$name}(...$arguments);
    }
}
