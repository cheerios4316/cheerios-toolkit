<?php

namespace Src\Components;

use Src\ComponentLoader\ComponentLoader;
use Src\Components\StyleProps;
use Src\Container\Container;

class Component
{
    use StyleProps;
    protected $name = '';
    protected $scope = 'src/Components';
    protected $area = '';

    protected static $id_list = [];

    protected $items = [];

    protected $dataAttrs = [];

    protected string $title = '';

    protected bool $disabled = false;

    protected function applySettings()
    {

    }

    public final function hydrate(array $data = []): self
    {
        foreach ($data as $key => $val) {
            if (property_exists($this, $key)) {
                $this->$key = $val;
            }
        }

        return $this;
    }

    public function render(): void
    {
        echo $this->content(true);
    }

    public function content(bool $includeAssets = false): string
    {
        $this->applySettings();

        $loader = Container::getInstance()->create(ComponentLoader::class);

        return $loader->setComponent($this, $this->disabled)->getHtml($includeAssets);
    }

    public final function getComponentPath(): string
    {
        return $this->scope . '/' . $this->area;
    }

    public final function getComponentName(): string
    {
        return $this->name;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $arr): self
    {
        $this->items = $arr;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function addItem($item): self
    {
        $this->items[] = $item;
        return $this;
    }

    public function addItems(...$items): self
    {
        $this->items = [...$this->items, ...$items];
        return $this;
    }

    public function renderDataAttrs(): string
    {
        $res = '';
        $this->dataAttrs = array_merge([
            'component' => $this->getClassName()
        ], $this->dataAttrs);
        foreach ($this->dataAttrs as $key => $val) {
            $escaped = htmlspecialchars($val);
            $res .= "data-$key=\"$escaped\" ";
        }

        return $res;
    }

    protected function getClassName(): string
    {
        return basename(str_replace('\\', '/', get_class($this)));
    }

    public function setDataAttrs(array $dataAttrs): self
    {
        $this->dataAttrs = $dataAttrs;
        return $this;
    }

    public function addDataAttr(string $key, string $value): self
    {
        $this->dataAttrs[$key] = $value;
        return $this;
    }

    public function disable(): self
    {
        $this->disabled = true;
        return $this;
    }
}