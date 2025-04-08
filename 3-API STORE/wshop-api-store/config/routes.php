<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add(
    'stores_list',
    new Route('/stores', [
        '_controller' => [App\Controller\StoreController::class, 'list']
    ])
);

return $routes;
