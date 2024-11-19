<?php

namespace Src\Classes\PageManager\PageDependency;
use Src\Container\Container;

class DependencyFactory
{

    public function createByType(string $type, string $arg = ''): ?DependencyInterface
    {
        $container = Container::getInstance();

        $dep = null;

        switch($type) {
            case DependencyConstants::$SCRIPT:
                $dep = $this->createJsDependency($arg);
                break;
            case DependencyConstants::$ICON:
                $dep = $this->createIconDependency($arg);
                break;
            case DependencyConstants::$STYLESHEET:
                $dep = $this->createCssDependency($arg);
                break;
        }

        return $dep;
    }

    public function createJsDependency(string $arg = ''): ScriptDependency
    {
        $dep = Container::getInstance()->create(ScriptDependency::class);

        if(!empty($arg)) {
            $dep->setSrc($arg);
        }

        return $dep;
    }

    public function createCssDependency(string $arg = ''): CssDependency
    {
        $dep = Container::getInstance()->create(CssDependency::class);

        if(!empty($arg)) {
            $dep->setHref($arg);
        }

        return $dep;
    }

    public function createIconDependency(string $arg = ''): IconDependency
    {
        $dep = Container::getInstance()->create(IconDependency::class);

        if(!empty($arg)) {
            $dep->setHref($arg);
        }

        return $dep;
    }

}