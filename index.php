<?php
header("Content-Type: text/html; charset=utf-8");

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define('ROOT', dirname(__FILE__));

session_start();

include ROOT . '/components/Autoload.php';

$router = new Router();
$router->run();