<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\Kernel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

Kernel::boot();

$env = $_ENV['APP_ENV'] ?? 'dev';

if ($env === 'dev') {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
}

$routes = require __DIR__ . '/../config/routes.php';

$request = Request::createFromGlobals();

$context = new RequestContext();
$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);

try {
    $parameters = $matcher->match($request->getPathInfo());

    $controllerInfo = $parameters['_controller'];
    unset($parameters['_controller'], $parameters['_route']);

    $controller = new $controllerInfo[0]();
    $method = $controllerInfo[1];

    $response = call_user_func_array([$controller, $method], $parameters);
} catch (ResourceNotFoundException $e) {
    $response = new JsonResponse(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
} catch (Exception $e) {
    $response = new JsonResponse(['message' => 'Internal Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
}

$response->send();