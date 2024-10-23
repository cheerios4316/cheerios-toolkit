<?php

namespace Src\Classes\PageManager;

use Src\Classes\PageManager\PageDependency\DependencyFactory;
use Src\Classes\PageManager\PageDependency\DependencyInterface;

class PageManager
{

    protected DependencyFactory $dependencyFactory;

    /** @var DependencyInterface[] */
    protected array $dependencies = [];

    public function __construct(DependencyFactory $dependencyFactory)
    {
        $this->dependencyFactory = $dependencyFactory;
    }

    private array $defaultDependencies = [
        [
            "type" => "script",
            "link" => "/vendor/components/jquery/jquery.min.js"
        ],
        [
            "type" => "stylesheet",
            "link" => "/public/css/tailwind.css"
        ],
        [
            "type" => "stylesheet",
            "link" => "/vendor/fortawesome/font-awesome/css/all.min.css"
        ],
        [
            "type" => "icon",
            "link" => "/public/assets/favicon.ico"
        ]
    ];

    public function getContentDependencies(): string
    {
        $result = '';

        foreach($this->getDependenciesWithDefault() as $dep) {
            $result .= $dep->render();
        }

        return $result;
    }

    public function renderDependencies(): self
    {
        echo $this->getContentDependencies();
        return $this;
    }

    public function renderHead(): self
    {
        echo "<head>";
        $this->renderDependencies();
        echo "</head>";
        return $this;
    }

    private function getDependenciesWithDefault(): array
    {
        $defaults = [];
        foreach($this->defaultDependencies as $dep) {
            $defaults[] = $this->dependencyFactory->createByType($dep['type'], $dep['link']);
        }

        return array_merge($defaults, $this->dependencies);
    }

    public function addDependencies(DependencyInterface $dependencies): self
     {
        $this->dependencies[] = $dependencies;
        return $this;
    }
}