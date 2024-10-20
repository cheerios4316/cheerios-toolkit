<?php

namespace Src\Classes\PageManager\PageDependency;

interface DependencyInterface
{
    public function render(): string;
}