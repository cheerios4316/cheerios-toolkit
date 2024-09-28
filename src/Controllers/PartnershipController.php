<?php

namespace Src\Controllers;
use Src\Components\PageComponent\PartnershipPageComponent\PartnershipPageComponent;

class PartnershipController extends Controller
{
    protected function generatePage(): \Src\Components\PageComponent\PageComponent
    {
        return new PartnershipPageComponent();
    }
}