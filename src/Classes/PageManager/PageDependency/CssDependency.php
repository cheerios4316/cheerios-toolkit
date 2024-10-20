<?php

namespace Src\Classes\PageManager\PageDependency;

class CssDependency extends LinkDependency
{
    protected string $rel = 'stylesheet';

    public function setHref(string $href): self
    {
        $this->href = $href;
        return $this;
    }
}