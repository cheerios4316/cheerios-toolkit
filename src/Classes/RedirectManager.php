<?php

namespace Src\Classes;
use ReflectionClass;
use Src\Controllers\ControllerInterface;

class RedirectManager
{
    protected static array $pathToController = [];

    protected PageLoader $pageLoader;

    protected ControllerLoader $controllerLoader;

    public function __construct(PageLoader $pageLoader, ControllerLoader $controllerLoader)
    {
        $this->pageLoader = $pageLoader;
        $this->controllerLoader = $controllerLoader;
    }

    public function redirect($destination)
    {
        header('Location: ' . $destination);
        exit();
    }

    public function autoloadControllers(): self
    {
        $implementations = $this->controllerLoader->getControllers();

        $this->setControllers($implementations);
        return $this;
    }

    public function setControllers(array $controllers)
    {
        foreach ($controllers as $name => $controller) {
            $this->addController($controller::getUrl(), $controller);
        }
    }

    private function addController($path, $controller): self
    {
        if (!empty($path)) {
            self::$pathToController[$path] = $controller;
        }
        return $this;
    }

    protected function handleSpecialPaths(string $path)
    {
        switch($path)
        {
            case '/':
                $this->redirect('/home');
                break;
        }
    }

    public function getPageHtml(string $uri): string
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

        return $this->pageLoader->loadPage($uriData, self::$pathToController);
    }
}