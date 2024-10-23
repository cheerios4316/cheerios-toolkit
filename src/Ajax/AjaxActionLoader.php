<?php

namespace Src\Ajax;

use ReflectionClass;
use Src\Ajax\AjaxActions\AjaxActionInterface;
use Src\Container\Container;

class AjaxActionLoader
{
    protected static array $implementations = [];
    
    public function getEndpoints()
    {
        if(empty(self::$implementations)) {
            self::$implementations = $this->fetchImplementations();
        }

        return self::$implementations;
    }

    protected function fetchImplementations(): array
    {
        $endpointsPath = $_SERVER['DOCUMENT_ROOT'] . '/src/Ajax/AjaxActions';
        foreach (glob($endpointsPath . '/*.php') as $file) {
            require_once $file;
        }

        $implementations = [];

        foreach (get_declared_classes() as $class) {
            $reflect = new ReflectionClass($class);
            if ($reflect->implementsInterface(AjaxActionInterface::class)) {
                $implementations[$this->getEndpointName($class)] = $class;
            }
        }

        return $implementations;
    }

    protected function getEndpointName(string $class): string
    {
        $class = Container::getInstance()->create($class);

        /** @var AjaxActionInterface $class */
        $endpoint = $class->getEndpoint();
        unset($class);
        return $endpoint;
    }
}