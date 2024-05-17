<?php

session_start();

require '../src/config/config.php';
require '../vendor/autoload.php';
require SRC . 'helper.php';

$router = new Portfolio\Router($_SERVER["REQUEST_URI"]);
$router->get('/', "ProjectController@index");
$router->get('/lp-admin/', "AdminController@showLogin");
$router->get('/lp-admin/admins/', "AdminController@index");
$router->get('/lp-admin/admins/:id/edit/', "AdminController@showEdit");
$router->get('/lp-admin/admins/:id/delete/', "AdminController@delete");
$router->get('/lp-admin/technos/', "TechnoController@index");
$router->get('/lp-admin/technos/:id/edit/', "TechnoController@showEdit");
$router->get('/lp-admin/technos/:id/delete/', "TechnoController@delete");
$router->get('/logout/', "AdminController@logout");

$router->post('/login/', "AdminController@login");
$router->post('/lp-admin/admins/create/', "AdminController@register");
$router->post('/lp-admin/admins/:id/update/', "AdminController@update");
$router->post('/lp-admin/technos/create/', "TechnoController@store");
$router->post('/lp-admin/technos/:id/update/', "TechnoController@update");

$router->run();
