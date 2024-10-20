<?php

namespace Src\Classes;
use ReflectionClass;
use Src\Controllers\ControllerInterface;
use Src\Controllers\HomeController;

class RedirectManager
{
    protected static array $pathToController = [];

    protected PageLoader $pageLoader;
    protected StringUtils $stringUtils;

    public function __construct()
    {
        $this->pageLoader = new PageLoader();
        $this->stringUtils = new StringUtils();
    }

    public function redirect($destination)
    {
        header('Location: ' . $destination);
        exit();
    }

    public function autoloadControllers(): self
    {
        $controllerPath = __DIR__ . '/src/Controllers';
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

    public function loadPage(string $uri)
    {
        $uriData = parse_url($uri);

        if ($uriData['path'] == '/') {
            $this->redirect('/home');
        }

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