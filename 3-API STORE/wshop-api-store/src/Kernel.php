<?php

namespace App;

use App\Controller\StoreController;
use App\Framework\ContainerFactory;
use App\Framework\Rooting\AttributeRouteLoader;
use App\Framework\Rooting\ControllerScanner;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

class Kernel
{
    private ContainerBuilder $container;
    private RouteCollection $routes;

    public function __construct()
    {
        $this->container = ContainerFactory::create();
        $this->initRoutes();
    }

    private function initRoutes(): void
    {
        $controllers = ControllerScanner::scan(__DIR__ . '/Controller');
        $this->routes = AttributeRouteLoader::load($controllers);
    }

    public function handle(Request $request)
    {
        $context = new RequestContext();
        $context->fromRequest($request);

        $matcher = new UrlMatcher($this->routes, $context);

        try {
            $parameters = $matcher->match($request->getPathInfo());
            [$controllerClass, $method] = $parameters['_controller'];

            $controller = $this->container->get($controllerClass);
            unset($parameters['_controller'], $parameters['_route']);

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