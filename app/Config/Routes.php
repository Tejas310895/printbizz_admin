<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'MainController::index');
$routes->match(['get', 'post'], 'orders-overview', 'OrdersController::index');
$routes->match(['get', 'post'], 'products-overview', 'ProductsController::index');

service('auth')->routes($routes);

$routes->resource('CallApiController');
$routes->post('add_image', 'CallApiController::image_upload');
