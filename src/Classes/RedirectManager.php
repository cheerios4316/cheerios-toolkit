<?php

namespace Src\Classes;
use ReflectionClass;
use Src\Controllers\ControllerInterface;
use Src\Controllers\HomeController;
use Src\Routing\RoutingInterface;

class RedirectManager
{
    protected static array $pathToController = [];

    protected PageLoader $pageLoader;

    public function __construct(PageLoader $pageLoader)
    {
        $this->pageLoader = $pageLoader;
    }

    public function redirect($destination)
    {
        header('Location: ' . $destination);
        exit();
    }

    /**
     * Registers routes
     *
     * @param RoutingInterface $routing
     * @return $this
     */
    public function addRouting(RoutingInterface $routing): self
    {
        foreach($routing->getRoutes() as $path => $controller) {
            $this->registerController($path, $controller);
        }

        return $this;
    }

    /**
     * Associates a controller class to a given /path/to/page/
     *
     * @param string $path
     * @param string $controller
     * @return $this
     */
    protected function registerController(string $path, string $controller): self
    {
        if (!empty($path)) {
            self::$pathToController[$path] = $controller;
        }
        return $this;
    }

    /**
     * Handles special redirect rules
     *
     * @param string $path
     * @return void
     * @deprecated will be removed once a divine intellect routing is implemented
     */
    protected function handleSpecialPaths(string $path): void
    {
        switch($path)
        {
            case '/':
                $this->redirect('/home');
                break;
        }
    }

    public function getController(string $uri): ControllerInterface
    {
        $uriData = parse_url($uri);

        $this->handleSpecialPaths($uriData['path']);

        if (!StringUtils::endsWith($uriData['path'], '/')) {
            $query = '';

            if (!empty($uriData['query'] ?? '')) {
                $query = '?' . $uriData['query'];
            }

            $this->redirect($uriData['path'] . '/' . $query);
        }

        return $this->pageLoader->getPageController($uriData, self::$pathToController);
    }
}