<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Main::index');
$routes->get('index', 'Main::index');
$routes->get('rocnik/(:num)', 'Main::rocnik/$1');