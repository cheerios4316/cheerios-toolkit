<?php

namespace Src\Classes;
use Detection\MobileDetect;

class Utils
{
    protected static ?MobileDetect $mobileDetect = null;

    /**
     * @return bool
     */
    public static function isMobile(): bool
    {
        $detect = self::getMobileDetect();

        return $detect->isMobile() && !$detect->isTablet();
    }

    protected static function getMobileDetect() {
        if(!self::$mobileDetect) {
            self::$mobileDetect = new MobileDetect();
        }

        return self::$mobileDetect;
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