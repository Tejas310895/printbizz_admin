<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'MainController::index');
$routes->match(['get', 'post'], 'orders-index', 'OrdersController::index');
$routes->match(['get', 'post'], 'products-index', 'ProductsController::index');
$routes->match(['get', 'post'], 'products-itemnary', 'ProductsController::itemnary');

service('auth')->routes($routes);

$routes->resource('CallApiController');
$routes->post('add_image', 'CallApiController::image_upload');
