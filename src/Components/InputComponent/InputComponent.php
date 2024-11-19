<?php

namespace Src\Components\InputComponent;

use Src\Components\Component;

class InputComponent extends Component
{
    protected $name = 'input';
    protected $area = 'InputComponent';

    protected string $inputName = '';

    protected string $inputType = 'text';

    protected string $placeholder = '';

    public function setInputName(string $inputName): self
    {
        $this->inputName = $inputName;
        return $this;
    }

    public function getInputName(): string
    {
        return $this->inputName;
    }

    public function setPlaceholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function getPlaceholder(): string
    {
        return $this->placeholder;
    }

    public function setInputType(string $inputType): self
    {
        $this->inputType = $inputType;
        return $this;
    }

    public function getInputType(): string
    {
        return $this->inputType;
    }
}