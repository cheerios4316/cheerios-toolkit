<?php

use Dotenv\Dotenv;
use Src\Classes\PageManager\PageManager;
use Src\Classes\RedirectManager;
use Src\Container\Container;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/vendor/autoload.php';

session_start();

// Init ENV file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Init Whoops stack trace for development only
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}

// Custom redirect manager
$redirectManager = new RedirectManager();

$pageManager = Container::getInstance()->create(PageManager::class);

$pageManager->renderHead();

$redirectManager->autoloadControllers()->loadPage($_SERVER['REQUEST_URI']);
