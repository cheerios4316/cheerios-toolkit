<?php

namespace Src\Controllers;
use Src\Components\PageComponent\HomePageComponent\HomePageComponent;
use Src\Components\PageComponent\PageComponent;

class HomeController extends BaseController
{
    public function generatePage(): PageComponent
    {
        return $this->container->create(HomePageComponent::class);
    }

    protected function getMeta(): array
    {
        return [
            'title' => 'Home Page'
        ];
    }
}