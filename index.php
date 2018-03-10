<?php
header("Content-Type: text/html; charset=utf-8");


define('ROOT', dirname(__FILE__));

session_start();

include ROOT . '/components/Autoload.php';

$router = new Router();
$router->run();