<?php

namespace Src\Components\PageComponent\HomePageComponent;
use Src\Components\FooterComponent\FooterComponent;
use Src\Components\PageComponent\PageComponent;
use Src\Container\Container;

class HomePageComponent extends PageComponent
{
    protected $name = 'home_page';
    protected $area = 'PageComponent/HomePageComponent';

    protected string $text = 'Sample Text';

    public function getText(): string
    {
        return $this->text;
    }
}