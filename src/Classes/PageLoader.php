<?php

namespace Src\Classes;
use Src\Container\Container;
use Src\Controllers\Page404Controller;

class PageLoader
{
    public function loadPage(array $uriData, array $paths = [])
    {
        $container = Container::getInstance();

        $currentPath = trim($uriData['path'], '/');

        if (key_exists($currentPath, $paths)) {
            $controllerClass = $paths[$currentPath];
            ($container->create($controllerClass))->renderPage();
        } else {
            ($container->create(Page404Controller::class))->renderPage();
        }
    }
}