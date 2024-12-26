<?php

namespace Src\Components\PageComponent\HomePageComponent;
use Src\Components\LinkComponent\LinkComponent;
use Src\Components\PageComponent\PageComponent;
use Src\Container\Container;

class HomePageComponent extends PageComponent
{
    protected $name = 'home_page';

    protected string $text = 'Sample Text';

    protected LinkComponent $linkComponent;

    protected function applySettings()
    {
        parent::applySettings();

        $this->linkComponent = Container::getInstance()->create(LinkComponent::class);
        $this->linkComponent->setHref('https://google.com')->setTargetBlank()->setText('blablabla');
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getLinkComponent(): LinkComponent
    {
        return $this->linkComponent;
    }
}