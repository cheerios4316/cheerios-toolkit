<?php

namespace Src\Controllers;
use Src\Components\PageComponent\PageComponent;
use Src\Components\PageComponent\PeoplePageComponent\PeoplePageComponent;

class PeopleController extends Controller
{
    protected function generatePage(): PageComponent
    {
        return new PeoplePageComponent();
    }
}