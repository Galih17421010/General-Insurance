<?php

use App\Controllers\Policy;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */



$routes->get('/login', 'Login::index');

$routes->get('/', 'Home::index');

$routes->resource('policy', [Policy::class]);
// $routes->post('/policy/data', 'Policy::getData');
