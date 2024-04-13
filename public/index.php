<?php

session_start();

require '../src/config/config.php';
require '../vendor/autoload.php';
require SRC . 'helper.php';

$router = new Portfolio\Router($_SERVER["REQUEST_URI"]);
$router->get('/login/', "UserController@showLogin");

$router->run();
