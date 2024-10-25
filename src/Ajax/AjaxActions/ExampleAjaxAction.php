<?php

namespace Src\Ajax\AjaxActions;

use Src\AutoCacher\AutoCacher;
use Src\Components\PageComponent\HomePageComponent\HomePageComponent;
use Src\Container\Container;

class ExampleAjaxAction implements AjaxActionInterface
{
    protected AutoCacher $autoCacher;
    public function __construct(AutoCacher $autoCacher)
    {
        $this->autoCacher = $autoCacher;
    }

    public function action(array $data = []): array
    {
        $component = Container::getInstance()->create(HomePageComponent::class);
        
        return ['html' => $component->content()];
    }

    public function getEndpoint(): string
    {
        return 'example';
    }
}