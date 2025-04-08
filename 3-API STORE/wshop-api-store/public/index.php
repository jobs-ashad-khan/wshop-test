<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\Controller\StoreController;
use App\Kernel;
use App\Rooting\AttributeRouteLoader;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$routeLoader = new AttributeRouteLoader([
    StoreController::class
]);

$response = new Kernel($routeLoader)->handle($request);

$response->send();