<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add(
    'stores_list',
    new Route(
        '/stores',
        ['_controller' => [App\Controller\StoreController::class, 'list']],
        methods: ['GET']
    )
);

$routes->add(
    'read_store',
    new Route(
        '/stores/{id}',
        ['_controller' => [App\Controller\StoreController::class, 'read']],
        methods: ['GET']
    )
);

return $routes;
