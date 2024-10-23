<?php

namespace Src\ComponentLoader;

use Src\Components\Component;

class FileLoader
{
    protected static $loaded_css = [];

    protected static $loaded_js = [];


    public function loadPhp(string $file, Component $component): string
    {
        if (!$this->checkAssets($file)) {
            return '';
        }

        ob_start();

        $this->includeFileWithBoundThis($file, $component);

        return ob_get_clean();
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
        echo '<script type="application/javascript" src="/' . htmlspecialchars($file) . '"></script>';
    }

    public function loadCss(string $file): void
    {
        if (!$this->checkAssets($file, self::$loaded_css)) {
            return;
        }

        self::$loaded_css[] = $file;
        echo '<link rel="stylesheet" type="text/css" href="/' . htmlspecialchars($file) . '">';
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