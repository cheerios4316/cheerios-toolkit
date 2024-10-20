<?php

namespace Src\Controllers;
use Src\Components\PageComponent\HomePageComponent\HomePageComponent;
use Src\Components\PageComponent\PageComponent;

class HomeController extends BaseController implements ControllerInterface
{
    public function generatePage(): PageComponent
    {
        return $this->container->create(HomePageComponent::class);
    }

    public static function getUrl(): string
    {
        return 'home';
    }
}