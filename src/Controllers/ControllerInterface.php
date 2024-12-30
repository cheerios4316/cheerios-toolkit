<?php

namespace Src\Controllers;
use Src\Components\PageComponent\PageComponent;

interface ControllerInterface
{
    public function generatePage(): PageComponent;
}