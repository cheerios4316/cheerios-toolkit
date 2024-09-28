<?php

namespace Src\Classes;
use Detection\MobileDetect;

class Utils
{
    protected static ?MobileDetect $mobileDetect = null;

    /**
     * @return bool
     */
    public function isMobile(): bool
    {
        $detect = $this->getMobileDetect();

        return $detect->isMobile() && !$detect->isTablet();
    }

    protected function getMobileDetect() {
        if(!self::$mobileDetect) {
            self::$mobileDetect = new MobileDetect();
        }

        return self::$mobileDetect;
    }
}