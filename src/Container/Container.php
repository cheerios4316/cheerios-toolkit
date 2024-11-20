<?php

namespace Src\Container;
use ReflectionClass;
use ReflectionException;
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
     * Creates a new instance of a class. If true, the second argument skips storing in cache
     *
     * @template T
     * @param class-string<T> $class
     * @param bool $skipCache
     * @return ?T
     */
    public function create(string $class, bool $skipCache = false): ?object
    {
        try {
            $reflection = new ReflectionClass($class);

            $cachedHash = md5($class);

            $deps = $this->dependencyResolver->resolve($reflection);

            $instance = $reflection->newInstanceArgs($deps);
            !$skipCache && self::$cached[$cachedHash] = $instance;

            return $instance;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getCached(string $class): object|null
    {
        $cachedHash = md5($class);

        if(!array_key_exists($cachedHash, self::$cached)) {
            return $this->create($class);
        }

        return self::$cached[$cachedHash];
    }

    public static function getInstance(): self
    {
        if(!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}