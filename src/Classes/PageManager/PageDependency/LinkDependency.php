<?php

namespace Src\Classes\PageManager\PageDependency;

class LinkDependency implements DependencyInterface
{
    protected string $href = '';

    protected string $rel = '';

    public function render(): string
    {
        return "<link rel=\"" . $this->rel . "\" href=\"" . $this->href . "\">";
    }

    public function setHref(string $href): self
    {
        $this->href = $href;
        return $this;
    }
}