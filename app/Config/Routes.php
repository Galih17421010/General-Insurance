<?php

use App\Controllers\Policy;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */



$routes->get('login', 'Login::index', ['filter' => 'guestGuard']);
$routes->match(['get', 'post'], 'Login/loginAuth', 'Login::loginAuth');
$routes->get('/logout', 'Login::logout');

$routes->get('/', 'Home::index', ['filter' => 'authGuard']);

$routes->resource('policy', [Policy::class,'filter' => 'authGuard']);
