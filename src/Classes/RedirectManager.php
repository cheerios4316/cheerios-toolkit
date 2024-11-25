<?php

namespace Src\Classes;
use Src\Controllers\ControllerInterface;
use Src\Routing\Redirection\RedirectionInterface;
use Src\Routing\RoutingInterface;

class RedirectManager
{
    protected static array $pathToController = [];

    protected static array $redirections = [];

    protected PageLoader $pageLoader;

    public function __construct(PageLoader $pageLoader)
    {
        $this->pageLoader = $pageLoader;
    }

    /**
     * Redirects to path
     * 
     * @param mixed $destination
     * @return never
     */
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
     * Registers a redirection
     * 
     * @param \Src\Routing\Redirection\RedirectionInterface $redirection
     * @return \Src\Classes\RedirectManager
     */
    public function addRedirection(RedirectionInterface $redirection): self
    {
        foreach($redirection->getRedirections() as $path => $destination) {
            $this->registerRedirect($path, $destination);
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
     * Forces redirect from given paths to destinations
     * 
     * @param string $path
     * @param string $destination
     * @return \Src\Classes\RedirectManager
     */
    protected function registerRedirect(string $path, string $destination): self
    {
        if (!empty($path)) {
            self::$redirections[$path] = $destination;
        }

        return $this;
    }

    /**
     * Handles special redirect rules
     *
     * @param string $path
     * @return void
     */
    protected function handleRedirect(string $path): void
    {
        if(!array_key_exists($path, self::$redirections)) {
            return;
        }

        $this->redirect(self::$redirections[$path]);
    }

    public function getController(string $uri): ControllerInterface
    {
        $uriData = parse_url($uri);

        $this->handleRedirect($uriData['path']);

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