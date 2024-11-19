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
                $dep = $container->create(ScriptDependency::class);
                if(!empty($arg)) {
                    $dep->setSrc($arg);
                }
                break;
            case DependencyConstants::$ICON:
                $dep = $container->create(IconDependency::class);
                if(!empty($arg)) {
                    $dep->setHref($arg);
                }
                break;
            case DependencyConstants::$STYLESHEET:
                $dep = $container->create(CssDependency::class);
                if(!empty($arg)) {
                    $dep->setHref($arg);
                }
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

}