<?php

namespace Src\Controllers;
use Src\Components\PageComponent\MentorsPageComponent\MentorsPageComponent;
use Src\Components\PageComponent\PageComponent;

class MentorsController extends Controller
{
    protected function generatePage(): PageComponent
    {
        return new MentorsPageComponent();
    }
}