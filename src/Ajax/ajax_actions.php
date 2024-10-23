<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Src\Ajax\AjaxController;
use Src\Container\Container;

$controller = Container::getInstance()->create(AjaxController::class);

$controller->execute();