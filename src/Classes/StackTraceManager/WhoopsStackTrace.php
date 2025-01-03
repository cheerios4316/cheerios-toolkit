<?php

namespace Src\Classes\StackTraceManager;

use Src\Container\Container;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class WhoopsStackTrace implements StackTraceInterface
{

    public function init(): void
    {
        $container = Container::getInstance();

        if (!$_SERVER['isDevelop']()) {
            return;
        }

        $whoops = $container->create(Run::class);
        $whoops->pushHandler($container->create(PrettyPageHandler::class));
        $whoops->register();
    }
}