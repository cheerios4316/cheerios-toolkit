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

    private array $defaultMeta = [
        "viewport" => "width=device-width, initial-scale=1.0"
    ];

    public function __construct()
    {
        $container = Container::getInstance();

        $this->headerComponent = $container->create(HeaderComponent::class);
        $this->sessionManager = $container->create(SessionManager::class);
        $this->footerComponent = $container->create(FooterComponent::class);
    }

    /**
     * @return FooterComponent
     */
    public function getFooterComponent(): FooterComponent
    {
        return $this->footerComponent;
    }

    public function getHeaderComponent(): HeaderComponent
    {
        return $this->headerComponent;
    }

    protected function getMetaHtmlTags(): string
    {
        $res = [];
        foreach ($this->getMetaWithDefault() as $key => $val) {
            if ($key == 'title') {
                $res[] = "<title>$val</title>";
            } else {
                $res[] = "<meta name=\"$key\" content=\"$val\">";
            }
        }

        return implode('\n', $res);
    }

    private function getMetaWithDefault()
    {
        return array_merge($this->defaultMeta, $this->getMeta());
    }

    /**
     * @return array
     */
    protected function getMeta(): array
    {
        return [];
    }

    public function render(): void
    {
        echo $this->getMetaHtmlTags();
        parent::render();
    }
}