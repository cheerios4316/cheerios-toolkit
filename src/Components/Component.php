<?php

namespace Src\Components;

use Src\Classes\StringUtils;
use Src\Components\StyleProps;

class Component
{
    use StyleProps;
    protected $name = '';
    protected $scope = 'src/Components';
    protected $area = '';

    protected static $loaded_css = [];
    protected static $loaded_js = [];

    protected static $id_list = [];

    protected $items = [];

    protected $dataAttrs = [];

    protected function applySettings()
    {
    }

    public function render(): void
    {
        $this->applySettings();

        $basePath = $this->scope . '/' . $this->area . '/' . $this->name;

        $filename = $basePath . '.php';
        $cssFilename = $basePath . '.css';
        $jsFilename = $basePath . '.js';

        $fileList = [
            'component_css' => $cssFilename,
            'component_js' => $jsFilename,
            'component' => $filename,
        ];

        $this->loadFiles($fileList);
    }

    private function loadFiles(array $list): void
    {
        foreach ($list as $file) {
            if (file_exists($file)) {
                $this->loadFile($file);
            }
        }
    }

    protected function loadFile(string $file)
    {
        if (StringUtils::endsWith($file, '.css')) {
            if (!in_array($file, self::$loaded_css)) {
                $this->loadCss($file);
            }
        } else if (StringUtils::endsWith($file, '.js')) {
            if (!in_array($file, self::$loaded_js)) {
                $this->loadJs($file);
            }
        } else if (StringUtils::endsWith($file, '.php')) {
            require $file;
        }
    }

    protected function loadCss(string $file)
    {
        self::$loaded_css[] = $file;
        $line = '<link rel="stylesheet" type="text/css" href="/' . htmlspecialchars($file) . '">';
        echo $line;
    }

    protected function loadJs(string $file)
    {
        self::$loaded_js[] = $file;
        echo '<script src="' . htmlspecialchars($file) . '"></script>';
    }

    public function getItems(): array {
        return $this->items;
    }
    
    public function setItems(array $arr) {
        $this->items = $arr;
        return $this;
    }

    public function addItem($item) {
        $this->items[] = $item;
        return $this;
    }

    public function addItems(...$items) {
        $this->items = [...$this->items, ...$items];
        return $this;
    }

    public function renderDataAttrs(): string
    {
        $res = '';
        foreach($this->dataAttrs as $key=>$val) {
            $escaped = htmlspecialchars($val);
            $res .= "data-$key=\"$escaped\" ";
        }

        return $res;
    }

    /**
     * @param array $dataAttrs
     * @return $this
     */
    public function setDataAttrs(array $dataAttrs): self
    {
        $this->dataAttrs = $dataAttrs;
        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function addDataAttr(string $key, string $value): self
    {
        $this->dataAttrs[$key] = $value;
        return $this;
    }
}