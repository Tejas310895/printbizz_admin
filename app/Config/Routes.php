<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'MainController::index');
$routes->match(['get', 'post'], 'orders-index', 'OrdersController::index');
$routes->match(['get', 'post'], 'products-index', 'ProductsController::index');
$routes->match(['get', 'post'], 'products-itemnary', 'ProductsController::itemnary');
$routes->match(['get', 'post'], 'customers-index', 'CustomersController::index');
$routes->match(['get', 'post'], 'institutions-index', 'InstitutionsController::index');
$routes->match(['get', 'post'], 'partners-index', 'PartnersController::index');

service('auth')->routes($routes);

$routes->resource('CallApiController');
$routes->post('add_image', 'CallApiController::image_upload');
