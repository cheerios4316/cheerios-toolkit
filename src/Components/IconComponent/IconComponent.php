<?php

namespace Src\Components\IconComponent;

use Src\Components\Component;

class IconComponent extends Component
{
    protected $name = 'icon';
    protected $area = 'IconComponent';

    protected $icon = '';

    protected ?string $type = null;

    public function __construct()
    {
        //something
    }

    /**
     * @param string $icon
     * @return IconComponent
     */
    public function setIcon(string $icon): IconComponent
    {
        $this->icon = $icon;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setRegular(): self
    {
        $this->type = 'regular';
        return $this;
    }

    public function setBrands(): self
    {
        $this->type = 'brands';
        return $this;
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }
}