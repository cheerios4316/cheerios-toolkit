<?php

namespace Src\Container;
use ReflectionClass;
use Src\Exceptions\ContainerException;

class Container
{
    protected static ?Container $instance = null;

    protected static array $cached = [];

    protected DependencyResolver $dependencyResolver;

    private function __construct()
    {
        $this->dependencyResolver = new DependencyResolver();
    }

    /**
     * Creates a new instance of a class. $getCached returns the latest cached instance of the class.
     * 
     * @param string $class
     * @param bool $getCached
     * @throws ContainerException
     * @return object|null
     */
    public function create(string $class, bool $getCached = false): object|null
    {
        $reflection = new ReflectionClass($class);

        $cachedHash = md5($class);

        if($getCached && $cachedInstance = self::$cached[$cachedHash]) {
            return $cachedInstance;
        }

        $deps = $this->dependencyResolver->resolve($reflection);

        $instance = $reflection->newInstanceArgs($deps);

        self::$cached[$cachedHash] = $instance;
        return $instance;
    }

    public static function getInstance(): self
    {
        if(!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}