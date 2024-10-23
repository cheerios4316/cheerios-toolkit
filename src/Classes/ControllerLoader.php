<?php

namespace Src\Classes;

use ReflectionClass;
use Src\Controllers\ControllerInterface;

class ControllerLoader
{
    public function getControllers(): array
    {
        $controllerPath = $_SERVER['DOCUMENT_ROOT'] . '/src/Controllers';
        foreach (glob($controllerPath . '/*.php') as $file) {
            require_once $file;
        }

        $implementations = [];

        foreach (get_declared_classes() as $class) {
            $reflect = new ReflectionClass($class);
            if ($reflect->implementsInterface(ControllerInterface::class)) {
                $implementations[] = $class;
            }
        }

        return $implementations;
    }
}