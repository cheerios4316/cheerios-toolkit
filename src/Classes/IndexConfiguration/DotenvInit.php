<?php

namespace Src\Classes\IndexConfiguration;

use Dotenv\Dotenv;

class DotenvInit implements InitActionInterface
{
    public function exec(): void
    {
        $dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
        $dotenv->load();
    }
}