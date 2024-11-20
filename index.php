<?php

use Src\Classes\IndexConfiguration\IndexConfiguration;
use Src\Classes\PageManager\PageManager;
use Src\Container\Container;

require_once __DIR__ . '/vendor/autoload.php';

session_start();

$container = Container::getInstance();

$initConfig = $container->create(IndexConfiguration::class);
$initConfig->init();

// Manage dependencies like favicon, JS and CSS in the PageManager
$pageManager = $container->create(class: PageManager::class);
$pageManager->renderPage();

/**
 * HOW TO EDIT ROUTING
 *
 * 1. Edit this array, add or remove routing areas:
 *    \Src\Classes\IndexConfiguration\RoutingInit::$routings
 *
 * 2. Implement/modify the getRoutes() method to bind controllers to routes
 *    example: \Src\Routing\DefaultRouting::getRoutes
 */