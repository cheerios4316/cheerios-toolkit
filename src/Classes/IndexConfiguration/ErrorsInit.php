<?php

namespace Src\Classes\IndexConfiguration;

class ErrorsInit implements InitActionInterface
{
    public function exec(): void
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }
}