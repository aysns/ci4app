<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->setAutoRoute(true);
$routes->get('/', 'Pages::index');
$routes->get('komik/create', 'Komik::create');
$routes->get('/komik/(:segment)','komik::detail/$1');
