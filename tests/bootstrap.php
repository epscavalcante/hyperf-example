<?php

declare(strict_types=1);

use Hyperf\Context\ApplicationContext;
use Hyperf\Di\ClassLoader;
use Hyperf\Di\Container;
use Hyperf\Di\Definition\DefinitionSourceFactory;

! defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));
require_once BASE_PATH.'/vendor/autoload.php';

(function () {
    ClassLoader::init();

    ApplicationContext::setContainer(
        new Container((new DefinitionSourceFactory)())
    );

    // $container->get(Hyperf\Contract\ApplicationInterface::class);
})();
