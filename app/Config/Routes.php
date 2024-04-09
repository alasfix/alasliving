<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/wishlist','Wishlist::index');
$routes->get('/wishlist/(:any)','Wishlist::slug/$1');
