<?php

namespace Src\ComponentLoader;

use Src\Components\Component;
use Src\Components\SearchbarComponent\SearchbarComponent;

class ComponentLoader
{
    protected Component $component;

    protected static array $fileTypes = ['php', 'css', 'js'];

    protected bool $includeAssets;

    protected FileLoader $fileLoader;

    protected bool $disabled = false;

    public function __construct(FileLoader $fileLoader)
    {
        $this->fileLoader = $fileLoader;
    }

    public function setComponent(Component $component, bool $disabled = false) : self
    {
        $this->component = $component;
        $this->disabled = $disabled;
        return $this;
    }

    public function getHtml(bool $includeAssets = false): string
    {
        $this->includeAssets = $includeAssets;

        $path = $this->component->getComponentPath();
        $name = $this->component->getComponentName();

        $fileNames = [];

        foreach(self::$fileTypes as $type) {
            $fileNames[$type] = $path . '/' . $name . '.' . $type;
        }
        return trim($this->loadFiles($fileNames));
    }

    protected function loadFiles(array $files): string
    {
        if($this->includeAssets) {
            $this->fileLoader->loadJs($files['js'] ?? '');
            $this->fileLoader->loadCss($files['css'] ?? '');
        }

        if($this->disabled) {
            return '';
        }
        
        return $this->fileLoader->loadPhp($files['php'] ?? '', $this->component);
    }
}