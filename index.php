<?php

use Dotenv\Dotenv;
use Src\Classes\RedirectManager;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__.'/vendor/autoload.php';

session_start();

// Init ENV file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Init Whoops stack trace for development only
if($_SERVER['HTTP_HOST'] === 'localhost') {
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}

// Custom redirect manager
$redirectManager = new RedirectManager();
?>

<link rel="stylesheet" href="public/css/tailwind.css"/>
<link rel="stylesheet" href="<?= '/vendor/fortawesome/font-awesome/css/all.min.css' ?>">
<link rel="shortcut icon" href="/public/assets/favicon.ico" />

<script src="/vendor/components/jquery/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" type="text/css" href="node_modules/slick-carousel/slick/slick.css"/>
<script type="text/javascript" src="node_modules/slick-carousel/slick/slick.min.js"></script>



<?php
$redirectManager->loadPage($_SERVER['REQUEST_URI']);
