<?php

namespace App;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

class Kernel
{
    private $routes;

    public function __construct()
    {
        $this->routes = require __DIR__ . '/../config/routes.php';
    }

    public function handle(Request $request)
    {
        $context = new RequestContext();
        $context->fromRequest($request);

        $matcher = new UrlMatcher($this->routes, $context);

        try {
            $parameters = $matcher->match($request->getPathInfo());

            $controllerInfo = $parameters['_controller'];
            unset($parameters['_controller'], $parameters['_route']);

            $controller = new $controllerInfo[0]();
            $method = $controllerInfo[1];

            $reflection = new \ReflectionMethod($controller, $method);
            $params = $reflection->getParameters();

            $paramTypes = array_map(fn($param) => $param->getType()?->getName(), $params);

            if (in_array(Request::class, $paramTypes, true)) {
                $parameters[] = $request;
            }

            $parameters = array_values($parameters);
            $response = call_user_func_array([$controller, $method], $parameters);
        } catch (ResourceNotFoundException $e) {
            $response = new JsonResponse(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            $response = new JsonResponse(['message' => 'Internal Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $response;
    }
}