<?php

namespace Src\Classes;

use Src\Controllers\JoinUsController;
use Src\Controllers\MentorsController;
use Src\Controllers\Page404Controller;
use Src\Controllers\HomeController;
use Src\Controllers\PartnershipController;
use Src\Controllers\PeopleController;
use Src\Controllers\UisPartnershipController;

class RedirectManager
{
    protected static array $pathToController = [];

    public function __construct()
    {
        if (empty(self::$pathToController)) {
            $this->setControllers();
        }
    }

    public function redirect($destination)
    {
        header('Location: ' . $destination);
        exit();
    }

    private function setControllers()
    {
        // this method adds to self::$pathToController
        $this
            ->addController('/home', HomeController::class)
        ;
    }

    private function addController($path, $controller): self
    {
        self::$pathToController[$path] = $controller;
        return $this;
    }

    public function loadPage(string $uri)
    {
        $uriData = parse_url($uri);

        $paths = self::$pathToController;

        if ($uriData['path'] == '/') {
            $this->redirect('/home');
        }

        if (key_exists($uriData['path'], $paths)) {
            $controllerClass = $paths[$uriData['path']];
            (new $controllerClass())->renderPage();
        } else {
            (new Page404Controller())->renderPage();
        }
    }
}