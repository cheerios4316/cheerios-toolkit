<?php

namespace Src\Classes;
use ReflectionClass;
use Src\Controllers\ControllerInterface;

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

    public function autoloadControllers(): self
    {
        $controllerPath = $_SERVER['DOCUMENT_ROOT'] . '/src/Controllers';
        foreach (glob($controllerPath . '/*.php') as $file) {
            require_once $file;
        }

        $implementations = [];

        foreach (get_declared_classes() as $class) {
            $reflect = new ReflectionClass($class);
            if ($reflect->implementsInterface(ControllerInterface::class)) {
                $implementations[] = $class;
            }
        }

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

    public function loadPage(string $uri)
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

        $this->pageLoader->loadPage($uriData, self::$pathToController);
    }
}