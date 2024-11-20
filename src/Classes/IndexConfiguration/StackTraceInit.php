<?php

namespace Src\Classes\IndexConfiguration;

use Src\Classes\StackTraceManager\WhoopsStackTrace;
use Src\Container\Container;

class StackTraceInit implements InitActionInterface
{
    public function exec(): void
    {
        $container = Container::getInstance();

        $container->create(WhoopsStackTrace::class)->init();
    }
}