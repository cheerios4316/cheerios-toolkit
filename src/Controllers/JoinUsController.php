<?php

namespace Src\Controllers;

use Src\Components\PageComponent\JoinUsPageComponent\JoinUsPageComponent;
use Src\Components\PageComponent\PageComponent;

class JoinUsController extends Controller
{
    protected function generatePage(): PageComponent
    {
        return new JoinUsPageComponent();
    }
}