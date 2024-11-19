<?php

namespace Src\Classes;
use Src\Container\Container;
use Src\Controllers\Page404Controller;

class PageLoader
{
    public function loadPage(array $uriData, array $paths = []): string
    {
        $container = Container::getInstance();

        $currentPath = trim($uriData['path'], '/');

        $html = '';

        if (key_exists($currentPath, $paths)) {
            $controllerClass = $paths[$currentPath];
            $html = ($container->create($controllerClass))->renderPage();
        } else {
            $html = ($container->create(Page404Controller::class))->renderPage();
        }

        return $html;
    }
}