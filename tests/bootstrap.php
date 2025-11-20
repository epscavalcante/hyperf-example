<?php
require_once __DIR__ . '/../vendor/autoload.php';

defined('BASE_PATH') or define('BASE_PATH', dirname(__DIR__, 1));

(function () {
    \Hyperf\Di\ClassLoader::init();

    \Hyperf\Context\ApplicationContext::setContainer(
        new \Hyperf\Di\Container((new \Hyperf\Di\Definition\DefinitionSourceFactory())())
    );
    
    // $container->get(Hyperf\Contract\ApplicationInterface::class);
})();
