<?php

namespace Src\ComponentLoader;

use Src\Components\Component;

class ComponentLoader
{
    protected Component $component;

    protected static array $fileTypes = ['php', 'css', 'js'];

    protected bool $includeAssets;

    protected FileLoader $fileLoader;

    public function __construct(FileLoader $fileLoader)
    {
        $this->fileLoader = $fileLoader;
    }

    public function setComponent(Component $component) : self
    {
        $this->component = $component;
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

        return $this->fileLoader->loadPhp($files['php'] ?? '', $this->component);
    }
}