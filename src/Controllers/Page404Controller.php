<?php

namespace Src\Controllers;

use Src\Components\Page404Component\Page404Component;
use Src\Components\PageComponent\PageComponent;

class Page404Controller extends Controller
{
    protected function generatePage(): PageComponent
    {
        return new Page404Component();
    }
}