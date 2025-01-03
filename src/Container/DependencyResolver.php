<?php

namespace Src\Container;
use ReflectionClass;
use Src\Exceptions\ContainerException;

class DependencyResolver
{
    /**
     * Resolves the dependencies of a given class and returns them in an array
     * 
     * @param ReflectionClass $reflection
     * @throws ContainerException
     * @return array
     */
    public function resolve(ReflectionClass $reflection): array
    {
        $constructor = $reflection->getConstructor();

        if(is_null($constructor)) {
            return [];
        }

        $params = $constructor->getParameters();
        $deps = [];

        foreach ($params as $param) {
            $dep = $param->getType()?->getName();

            if($dep) {
                $deps[] = Container::getInstance()->create($dep);
            } else {
                throw new ContainerException("Container cannot resolve dependency");
            }
        }

        return $deps;
    }
}