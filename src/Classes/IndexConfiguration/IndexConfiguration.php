<?php

namespace Src\Classes\IndexConfiguration;

use Src\Container\Container;

class IndexConfiguration
{
    /** @var InitActionInterface[] */
    protected array $initActions = [];

    /** @var string[] */
    protected array $initActionClassList = [
        ErrorsInit::class,
        StackTraceInit::class,
        DotenvInit::class,
        RoutingInit::class
    ];

    public function __construct()
    {
        $this->registerActions();
    }

    public function init(): void
    {
        foreach($this->initActions as $action) {
            $action->exec();
        }
    }

    protected function registerActions(): void
    {
        $container = Container::getInstance();

        foreach($this->initActionClassList as $actionClass) {
            $this->initActions[] = $container->create($actionClass);
        }
    }
}

