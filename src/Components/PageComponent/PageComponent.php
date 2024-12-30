<?php

namespace Src\Components\PageComponent;
use Src\Classes\PageManager\PageManager;
use Src\Classes\SessionManager;
use Src\Components\Component;
use Src\Components\HeaderComponent\HeaderComponent;
use Src\Components\ImageBannerComponent\ImageBannerComponent;
use Src\Components\FooterComponent\FooterComponent;
use Src\Container\Container;

class PageComponent extends Component
{
    protected $name = 'page';

    protected HeaderComponent $headerComponent;
    protected SessionManager $sessionManager;

    protected FooterComponent $footerComponent;

    public function __construct()
    {
        $container = Container::getInstance();

        $this->headerComponent = $container->create(HeaderComponent::class);
        $this->sessionManager = $container->create(SessionManager::class);
        $this->footerComponent = $container->create(FooterComponent::class);
    }

    public function getFooterComponent(): FooterComponent
    {
        return $this->footerComponent;
    }

    public function getHeaderComponent(): HeaderComponent
    {
        return $this->headerComponent;
    }
}