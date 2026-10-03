<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login');
$routes->post('logout', 'Auth::logout');

$routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->get('accounts/create', 'Home::create', ['filter' => 'auth']);
$routes->post('accounts/store', 'Home::store', ['filter' => 'auth']);
$routes->get('accounts/edit/(:num)', 'Home::edit/$1', ['filter' => 'auth']);
$routes->post('accounts/update/(:num)', 'Home::update/$1', ['filter' => 'auth']);
$routes->post('accounts/delete/(:num)', 'Home::delete/$1', ['filter' => 'auth']);
$routes->get('account/(:num)', 'Home::viewAccount/$1', ['filter' => 'auth']);