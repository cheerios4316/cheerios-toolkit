<?php

namespace Src\Components;

use Src\Classes\StringUtils;
use Src\Components\StyleProps;

class Component
{
    use StyleProps;
    protected $name = '';
    protected $scope = './src/Components';
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
        echo $this->content(true);
    }

    public function content(bool $includeAssets = false): string
    {
        $this->applySettings();

        $basePath = $this->scope . '/' . $this->area . '/' . $this->name;

        $filename = $basePath . '.php';
        $cssFilename = $basePath . '.css';
        $jsFilename = $basePath . '.js';

        $assets = [];

        if ($includeAssets) {
            $assets = [
                'component_css' => $cssFilename,
                'component_js' => $jsFilename,
            ];
        }

        $fileList = [
            ...$assets,
            'component' => $filename,
        ];

        return $this->loadFiles($fileList);
    }

    private function loadFiles(array $list): string
    {
        $html = '';
        foreach ($list as $file) {
            if (file_exists($file)) {
                $html .= $this->loadFile($file);
            }
        }

        return $html;
    }

    protected function loadFile(string $file): string
    {
        if (StringUtils::endsWith($file, '.css')) {
            if (!in_array($file, self::$loaded_css)) {
                return $this->loadCss($file);
            }
        } elseif (StringUtils::endsWith($file, '.js')) {
            if (!in_array($file, self::$loaded_js)) {
                return $this->loadJs($file);
            }
        } elseif (StringUtils::endsWith($file, '.php')) {
            ob_start();
            require $file;
            return ob_get_clean();
        }
        return '';
    }

    protected function loadCss(string $file): string
    {
        self::$loaded_css[] = $file;
        return '<link rel="stylesheet" type="text/css" href="/' . htmlspecialchars($file) . '">';
    }

    protected function loadJs(string $file): string
    {
        self::$loaded_js[] = $file;
        return '<script type="application/javascript" src="/' . htmlspecialchars($file) . '"></script>';
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $arr)
    {
        $this->items = $arr;
        return $this;
    }

    public function addItem($item)
    {
        $this->items[] = $item;
        return $this;
    }

    public function addItems(...$items)
    {
        $this->items = [...$this->items, ...$items];
        return $this;
    }

    public function renderDataAttrs(): string
    {
        $res = '';
        foreach ($this->dataAttrs as $key => $val) {
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