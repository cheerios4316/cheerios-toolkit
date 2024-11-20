<?php

namespace Src\Classes;
use Detection\MobileDetect;
use Src\Container\Container;

class Utils
{
    /**
     * @return bool
     */
    public static function isMobile(): bool
    {
        try {
            $detect = Container::getInstance()->create(MobileDetect::class);

            return $detect->isMobile() && !$detect->isTablet();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getImplementations(string $interfaceName): array
    {
        $implementations = [];
        foreach (get_declared_classes() as $class) {
            $reflect = new \ReflectionClass($class);
            if ($reflect->implementsInterface($interfaceName)) {
                $implementations[] = $class;
            }
        }
        return $implementations;
    }
}