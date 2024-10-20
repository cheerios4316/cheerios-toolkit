<?php

namespace Src\Exceptions;
use Exception;

class ContainerException extends Exception
{
    public function __construct($message = "There was a problem with the Container."){}
}