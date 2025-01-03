<?php

namespace Src\Classes\IndexConfiguration;

class ServerMethodsInit implements InitActionInterface
{

    protected static array $allowedHosts = [
        '127.0.0.1',
        'localhost'
    ];

    public function exec(): void
    {
        $_SERVER['isDevelop'] = function() {
            return $this->isDevelop();
        };
    }

    protected function isDevelop(): bool
    {
        return in_array($_SERVER['HTTP_HOST'], self::$allowedHosts);
    }
}