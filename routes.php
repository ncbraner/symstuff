<?php


use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

use App\Controllers\IndexController;

$routes = new RouteCollection();

$routes->add(
    'home',
    new Route('/', ['controller' => IndexController::class, '_method' => 'Index'])
);

return $routes;