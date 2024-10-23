<?php

use Dotenv\Dotenv;
use Src\Classes\PageManager\PageManager;
use Src\Classes\RedirectManager;
use Src\Classes\StackTraceManager\WhoopsStackTrace;
use Src\Container\Container;

require_once __DIR__ . '/vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Init ENV file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$container = Container::getInstance();

// Init Whoops stack trace for development only
$container->create(WhoopsStackTrace::class)->init();

// Custom redirect manager
$redirectManager = $container->create(RedirectManager::class);

// Manage dependencies like favicon, JS and CSS in the PageManager
$pageManager = $container->create(class: PageManager::class)->renderHead();

$redirectManager->autoloadControllers()->loadPage($_SERVER['REQUEST_URI']);
