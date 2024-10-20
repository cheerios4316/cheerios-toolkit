<?php

namespace Src\Classes\PageManager\PageDependency;

class ScriptDependency implements DependencyInterface
{
    protected string $src = '';

    public function render(): string
    {
        return "<script src=\"" . $this->src . "\"></script>";
    }

    public function setSrc(string $src): self
    {
        $this->src = $src;
        return $this;
    }
}