<?php

namespace Src\Components\PageComponent\HomePageComponent;
use Src\Components\PageComponent\PageComponent;

class HomePageComponent extends PageComponent
{
    protected $name = 'home_page';

    protected string $text = 'Sample Text';
    public function getText(): string
    {
        return $this->text;
    }
}