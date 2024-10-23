<?php

namespace Src\Controllers;

use Src\Components\Page404Component\Page404Component;
use Src\Components\PageComponent\HomePageComponent\HomePageComponent;
use Src\Components\PageComponent\PageComponent;

class Page404Controller extends BaseController implements ControllerInterface
{
    public function generatePage(): PageComponent
    {
        //return new HomePageComponent();
        //return new Page404Component();
    }

    public static function getUrl(): string
    {
        return '';
    }
}