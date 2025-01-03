<?php

namespace Src\Classes;
use Src\Container\Container;
use Src\Controllers\ControllerInterface;
use Src\Controllers\BaseController;

class PageLoader
{
    public function getPageController(array $uriData, array $paths = []): ?ControllerInterface
    {
        $container = Container::getInstance();

        /** @var ControllerInterface $controller */
        $controller = null;

        foreach($paths as $path => $controllerClass) {
            $params = $this->matchAndGetParams($path, trim($uriData['path'], '/'));

            if(is_null($params)) {
                continue;
            }

            /** @var BaseController $controller */
            $controller = $container->create($controllerClass);

            $controller->setParams($params);
        }

        return $controller;
    }

    protected function matchAndGetParams(string $path, string $url): ?array
    {
        /*
         * Derives a pattern from a path
         *      e.g. turns home/{id}/test into #^/home/(?P<id>[^/]+)$#
         */

        $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $path);
        $pattern = '#^' . str_replace('\\/', '/', $pattern) . '$#';

        // If pattern is matched it returns an array containing the URL params
        if(preg_match($pattern, $url, $matches)) {
            return array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
        }

        return null;
    }
}