<?php

namespace Src\Classes\IndexConfiguration;

use Src\Container\Container;

class IndexConfiguration
{
    /** @var InitActionInterface[] */
    protected array $initActions = [];

    /** @var class-string<InitActionInterface>[] */
    protected array $initActionClassList = [
        ErrorsInit::class,
        StackTraceInit::class,
        DotenvInit::class,
        RoutingInit::class,
        RedirectionInit::class
    ];

    public function __construct()
    {
        $this->registerActions();
    }

    /**
     * Launches all the init actions
     *
     * @return self
     */
    public function init(): self
    {
        foreach($this->initActions as $action) {
            $action->exec();
        }

        return $this;
    }

    /**
     * Adds another action to the list
     *
     * @param InitActionInterface $action
     * @return $this
     */
    public function addAction(InitActionInterface $action): self
    {
        $this->initActions[] = $action;

        return $this;
    }

    /**
     * Registers default init actions
     *
     * @return void
     */
    protected function registerActions(): void
    {
        $container = Container::getInstance();

        foreach($this->initActionClassList as $actionClass) {
            $this->initActions[] = $container->create($actionClass);
        }
    }
}

