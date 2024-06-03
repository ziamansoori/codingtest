<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('api/login', 'API\UsersController::login');
$routes->options('api/(:any)', static function () {});

$routes->group('api', ['filter' => 'authJwt'], static function($routes) {
    $routes->get('cars', 'API\CarsController::index');
    $routes->post('cars', 'API\CarsController::store');
    $routes->put('cars/(:num)', 'API\CarsController::updateShippingStatus/$1'); 
    $routes->get('cars-make', 'API\CarsMakeController::index');
});