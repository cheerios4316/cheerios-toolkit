<?php

namespace Src\Routing;

use Src\Controllers\HomeController;

class DefaultRouting implements RoutingInterface
{
    public function getRoutes(): array
    {
        return [
            'home' => HomeController::class,
            'home/{id}/prova' => HomeController::class,
        ];
    }
}