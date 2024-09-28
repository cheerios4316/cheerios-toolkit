<?php

namespace Src\Controllers;
use Src\Components\PageComponent\HomePageComponent\HomePageComponent;
use Src\Components\PageComponent\PageComponent;

class HomeController extends Controller
{
    protected function generatePage(): PageComponent
    {
        return new HomePageComponent();
    }
}