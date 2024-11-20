<?php

namespace Src\Components;

use Src\ComponentLoader\ComponentLoader;
use Src\Container\Container;
use Src\Exceptions\ContainerException;

class Component
{
    use StyleProps;
    protected $name = '';
    protected $scope = 'src/Components';
    protected $area = '';

    protected array $items = [];

    protected array $dataAttrs = [];

    protected string $title = '';

    protected ?ComponentLoader $componentLoader = null;

    /**
     * Defines whether the component should be disabled or not
     * 
     * @var bool
     */
    protected bool $disabled = false;

    /**
     * Defines whether data attributes should be rendered automatically
     * 
     * @var bool
     */
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
     * @return Component
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
     * @throws ContainerException
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
     * @throws ContainerException
     */
    public function content(bool $includeAssets = false): string
    {
        $this->applySettings();

        return $this->getComponentLoader()->getHtml($includeAssets);
    }

    /**
     * Returns the Component's parent HTML content
     *
     * @param bool $includeAssets
     * @return string
     * @throws ContainerException
     */
    public function parentContent(bool $includeAssets = true): string
    {
        $parentClass = get_parent_class($this);;

        if(!is_subclass_of($parentClass, Component::class)) {
            return '';
        }

        $parentInstance = Container::getInstance()->create($parentClass);

        return $parentInstance->content(true);
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
     * @throws ContainerException
     */
    protected function getComponentLoader(): ComponentLoader
    {
        if (!$this->componentLoader) {
            $this->componentLoader = Container::getInstance()->create(ComponentLoader::class)->setComponent($this);
        }

        return $this->componentLoader;
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
     * @return Component
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
     * @return Component
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
    public function addItem(mixed $item): self
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * Adds N items to $items
     * 
     * @param array $items
     * @return Component
     */
    public function addItems(...$items): self
    {
        $this->items = [...$this->items, ...$items];
        return $this;
    }

    /**
     * Getter for the class' name
     * 
     * @return string
     */
    protected function getClassName(): string
    {
        return basename(str_replace('\\', '/', get_class($this)));
    }

    /**
     * Setter for $dataAttrs
     * 
     * @param array $dataAttrs
     * @return Component
     */
    public function setDataAttrs(array $dataAttrs): self
    {
        $this->dataAttrs = $dataAttrs;
        return $this;
    }

    /**
     * Adds an element to $dataAttrs
     * 
     * @param string $key
     * @param string $value
     * @return Component
     */
    public function addDataAttr(string $key, string $value): self
    {
        $this->dataAttrs[$key] = $value;
        return $this;
    }

    /**
     * Disables the component's view
     * 
     * @return Component
     */
    public function disable(): self
    {
        $this->disabled = true;
        return $this;
    }

    /**
     * Returns true if data attributes should be rendered automatically
     * 
     * @return bool
     */
    public function shouldRenderDataAttrs(): bool
    {
        return $this->renderDataAttrs;
    }
}