<?php

namespace Src\Components\PageComponent;
use Src\Classes\SessionManager;
use Src\Components\Component;
use Src\Components\HeaderComponent\HeaderComponent;
use Src\Components\ImageBannerComponent\ImageBannerComponent;
use Src\Components\FooterComponent\FooterComponent;

class PageComponent extends Component
{
    protected $name = 'page';
    protected $area = 'PageComponent';

    protected array $meta = [];
    protected HeaderComponent $headerComponent;
    protected SessionManager $sessionManager;

    protected FooterComponent $footerComponent;

    public function __construct()
    {
        $this->headerComponent = new HeaderComponent();
        $this->sessionManager = new SessionManager();
        $this->footerComponent = new FooterComponent();
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
        foreach ($this->meta as $key => $val) {
            if ($key == 'title') {
                $res[] = "<title>$val</title>";
            } else {
                $res[] = "<meta name=\"$key\" content=\"$val\">";
            }
        }

        return implode('\n', $res);
    }

    public function render(): void
    {
        echo $this->getMetaHtmlTags();
        parent::render();
    }
}