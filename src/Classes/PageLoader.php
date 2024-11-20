<?php

namespace Src\Classes;
use Src\Container\Container;
use Src\Controllers\ControllerInterface;
use Src\Controllers\Page404Controller;

class PageLoader
{
    public function getPageController(array $uriData, array $paths = []): ?ControllerInterface
    {
        $container = Container::getInstance();

        $currentPath = trim($uriData['path'], '/');

        /** @var ControllerInterface $controller */
        $controller = null;

        if (key_exists($currentPath, $paths)) {
            $controllerClass = $paths[$currentPath];
            $controller = $container->create($controllerClass);
        } else {
            $controller = $container->create(Page404Controller::class);
        }

        return $controller;
    }
}