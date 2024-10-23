<?php

namespace Src\Classes\StackTraceManager;

use Src\Container\Container;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class WhoopsStackTrace implements StackTraceInterface
{
    protected static $allowedHosts = [
        'localhost',
        '127.0.0.1'
    ];

    public function init(): void
    {
        $container = Container::getInstance();

        if (in_array($_SERVER['HTTP_HOST'], self::$allowedHosts)) {
            $whoops = $container->create(Run::class);
            $whoops->pushHandler($container->create(PrettyPageHandler::class));
            $whoops->register();
        }
    }
}