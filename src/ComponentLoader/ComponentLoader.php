<?php

namespace Src\ComponentLoader;

use Src\Components\Component;

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

    /**
     * Returns the HTML of a Component
     * 
     * @param bool $includeAssets
     * @return string
     */
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

    /**
     * Loads the files related to a Component
     * 
     * @param array $files
     * @return string
     */
    protected function loadFiles(array $files): string
    {
        // Includes assets even if the component is disabled
        if($this->includeAssets) {
            $this->fileLoader->loadJs($files['js'] ?? '');
            $this->fileLoader->loadCss($files['css'] ?? '');
        }

        if($this->disabled) {
            return '';
        }
        
        return $this->fileLoader->loadPhp($files['php'] ?? '', $this->component, $this->component->shouldRenderDataAttrs());
    }
}