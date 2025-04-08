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
    'create_store',
    new Route(
        '/stores',
        ['_controller' => [App\Controller\StoreController::class, 'create']],
        methods: ['POST']
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

$routes->add(
    'update_store',
    new Route(
        '/stores/{id}',
        ['_controller' => [App\Controller\StoreController::class, 'update']],
        methods: ['PUT', 'PATCH']
    )
);

$routes->add(
    'delete_store',
    new Route(
        '/stores/{id}',
        ['_controller' => [App\Controller\StoreController::class, 'delete']],
        methods: ['DELETE']
    )
);

return $routes;
