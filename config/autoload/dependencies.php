<?php

use App\Application\Repositories\AccountRepositoryInterface;
use App\Infraestructure\Repositories\AccountFakeRepository;
use App\Infraestructure\Repositories\AccountQueryBuilderRepository;

return [
    // AccountRepositoryInterface::class => AccountFakeRepository::class,
    AccountRepositoryInterface::class => AccountQueryBuilderRepository::class,
];
