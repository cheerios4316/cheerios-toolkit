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

    /**
     * Binds the content of a Component's PHP file to the Component's $this context
     * 
     * @param string $file
     * @param \Src\Components\Component $component
     * @return void
     */
    protected function includeFileWithBoundThis(string $file, Component $component): void
    {
        $includeClosure = function () use ($file) {
            require $file;
        };

        $boundClosure = $includeClosure->bindTo($component, get_class($component));

        $boundClosure();
    }

    /**
     * Loads a PHP file
     * 
     * @param string $file
     * @param Component $component
     * @param bool $renderDataAttrs
     * @return string
     */
    public function loadPhp(string $file, Component $component, bool $renderDataAttrs = true): string
    {
        if (!$this->checkAssets($file)) {
            return '';
        }

        ob_start();

        $this->includeFileWithBoundThis($file, $component);

        $html = ob_get_clean();

        if ($renderDataAttrs) {
            $dataAttrs = $component->renderDataAttrs();
            $html = preg_replace('/(<div[^>]*)(>)/', '$1 ' . $dataAttrs . '$2', $html, 1);
        }

        return $html;
    }

    /**
     * Loads a JS file (enqueues into assets queue and renders in <head>)
     * 
     * @param string $file
     * @return void
     */
    public function loadJs(string $file): void
    {
        if (!$this->checkAssets($file, self::$loaded_js)) {
            return;
        }

        self::$loaded_js[] = $file;
        $dependency = $this->dependencyFactory->createJsDependency('/' . htmlspecialchars($file));
        PageManager::addDependency($dependency);
    }

    /**
     * Loads a CSS file (enqueues into assets queue and renders in <head>)
     * 
     * @param string $file
     * @return void
     */
    public function loadCss(string $file): void
    {
        if (!$this->checkAssets($file, self::$loaded_css)) {
            return;
        }

        self::$loaded_css[] = $file;
        $dependency = $this->dependencyFactory->createCssDependency('/' . htmlspecialchars($file));
        PageManager::addDependency($dependency);
    }

    /**
     * Checks if a file exists and it's already enqueued in the assets manager
     * 
     * @param string $file
     * @param array $loaded
     * @return bool
     */
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