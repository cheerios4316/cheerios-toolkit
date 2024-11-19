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

    protected array $items = [];

    protected array $dataAttrs = [];

    protected string $title = '';

    protected bool $disabled = false;

    protected bool $renderDataAttrs = true;

    /**
     * Override this method. This will be executed right
     * before the render of the component
     * 
     * @return void
     */
    protected function applySettings()
    {

    }

    /**
     * Simple hydrator. Pass [keys => values] into.
     * 
     * @param array $data
     * @return \Src\Components\Component
     */
    public final function hydrate(array $data = []): self
    {
        foreach ($data as $key => $val) {
            if (property_exists($this, $key)) {
                $this->$key = $val;
            }
        }

        return $this;
    }

    /**
     * Renders the data attributes in the component.
     * This is called automatically at Component's render
     * 
     * @return string
     */
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
     * Renders the Component into the page
     * 
     * @return void
     */
    public function render(): void
    {
        echo $this->content(true);
    }

    /**
     * Returns the HTML of the Component
     * 
     * @param bool $includeAssets
     * @return string
     */
    public function content(bool $includeAssets = false): string
    {
        $this->applySettings();

        $loader = Container::getInstance()->create(ComponentLoader::class);

        return $loader->setComponent($this, $this->disabled)->getHtml($includeAssets);
    }

    /**
     * Getter for the Component's files path
     * 
     * @return string
     */
    public final function getComponentPath(): string
    {
        return $this->scope . '/' . $this->area;
    }

    /**
     * Getter for the Component's file names
     * 
     * @return string
     */
    public final function getComponentName(): string
    {
        return $this->name;
    }

    /**
     * Getter for $items
     * 
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Setter for $items
     * 
     * @param array $arr
     * @return \Src\Components\Component
     */
    public function setItems(array $arr): self
    {
        $this->items = $arr;
        return $this;
    }

    /**
     * Getter for $title
     * 
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Setter for $title
     * 
     * @param string $title
     * @return \Src\Components\Component
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Adds an item to $items
     * 
     * @param mixed $item
     * @return Component
     */
    public function addItem($item): self
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * Adds N items to $items
     * 
     * @param array $items
     * @return \Src\Components\Component
     */
    public function addItems(...$items): self
    {
        $this->items = [...$this->items, ...$items];
        return $this;
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

    public function shouldRenderDataAttrs(): bool
    {
        return $this->renderDataAttrs;
    }
}