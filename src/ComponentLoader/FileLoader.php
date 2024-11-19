<?php

namespace Src\ComponentLoader;

use Src\Classes\PageManager\PageDependency\DependencyFactory;
use Src\Classes\PageManager\PageManager;
use Src\Components\Component;
use Src\Container\Container;

class FileLoader
{
    protected static $loaded_css = [];

    protected static $loaded_js = [];

    protected DependencyFactory $dependencyFactory;

    public function __construct(DependencyFactory $dependencyFactory)
    {
        $this->dependencyFactory = $dependencyFactory;
    }


    public function loadPhp(string $file, Component $component): string
    {
        if (!$this->checkAssets($file)) {
            return '';
        }

        ob_start();

        $this->includeFileWithBoundThis($file, $component);

        $html = ob_get_clean();

        $dataAttrs = $component->renderDataAttrs();

        return preg_replace('/(<div[^>]*)(>)/', '$1 ' . $dataAttrs . '$2', $html, 1);
    }

    protected function includeFileWithBoundThis(string $file, Component $component): void
    {
        $includeClosure = function () use ($file) {
            require $file;
        };

        $boundClosure = $includeClosure->bindTo($component, get_class($component));

        $boundClosure();
    }

    public function loadJs(string $file): void
    {
        if (!$this->checkAssets($file, self::$loaded_js)) {
            return;
        }

        self::$loaded_js[] = $file;
        $dependency = $this->dependencyFactory->createJsDependency('/' . htmlspecialchars($file));
        PageManager::addDependency($dependency);
    }

    public function loadCss(string $file): void
    {
        if (!$this->checkAssets($file, self::$loaded_css)) {
            return;
        }

        self::$loaded_css[] = $file;
        $dependency = $this->dependencyFactory->createCssDependency('/' . htmlspecialchars($file));
        PageManager::addDependency($dependency);
    }

    protected function checkAssets(string $file, array $loaded = []): bool
    {
        if (!file_exists($file)) {
            return false;
        }

        if (in_array($file, $loaded)) {
            return false;
        }

        return true;
    }
}