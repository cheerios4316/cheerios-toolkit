<?php

namespace Src\Components\LinkComponent;

use Src\Components\Component;

class LinkComponent extends Component
{
    protected $name = 'link';
    protected $area = 'LinkComponent';

    protected string $href = '';
    
    protected string $text = '';

    protected bool $targetBlank = false;

    public function setHref(string $href): self
    {
        $this->href = $href;
        return $this;
    }

    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    public function getHref(): string
    {
        return $this->href;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setTargetBlank(bool $targetBlank = true): self
    {
        $this->targetBlank = $targetBlank;
        return $this;
    }

    public function isTargetBlank(): bool
    {
        return $this->targetBlank;
    }
}