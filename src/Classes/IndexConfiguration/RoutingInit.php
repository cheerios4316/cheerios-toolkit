<?php

namespace Src\Classes\IndexConfiguration;

use Src\Classes\RedirectManager;
use Src\Container\Container;
use Src\Routing\DefaultRouting;

class RoutingInit implements InitActionInterface
{
    protected array $routings = [
        DefaultRouting::class,
    ];

    public function exec(): void
    {
        $container = Container::getInstance();

        $redirectManager = $container->create(RedirectManager::class);

        foreach($this->routings as $routing) {
            $routingObj = $container->create($routing);

            $redirectManager->addRouting($routingObj);
        }
    }
}