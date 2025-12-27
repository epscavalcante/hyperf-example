<?php

use Core\Application\Repositories\AccountRepositoryInterface;
use App\Repositories\AccountFakeRepository;
use App\Repositories\AccountModelRepository;
use App\Repositories\AccountQueryBuilderRepository;

return [
    // AccountRepositoryInterface::class => AccountFakeRepository::class,
    // AccountRepositoryInterface::class => AccountQueryBuilderRepository::class,
    AccountRepositoryInterface::class => AccountModelRepository::class,
];
