<?php

namespace App\Rooting;

use App\Attribute\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route as SymfonyRoute;

class AttributeRouteLoader implements RouteLoaderInterface
{
    private array $controllers;

    public function __construct(array $controllers = []) {
        $this->controllers = $controllers;
    }

    /**
     * @throws \ReflectionException
     */
    public function getRoutes(): RouteCollection
    {
        $routes = new RouteCollection();

        foreach ($this->controllers as $controllerClass) {
            $reflection = new \ReflectionClass($controllerClass);
            foreach ($reflection->getMethods() as $method) {
                foreach ($method->getAttributes(Route::class) as $attribute) {
                    /** @var Route $routeAttr */
                    $routeAttr = $attribute->newInstance();

                    $routes->add($routeAttr->name, new SymfonyRoute(
                        $routeAttr->path,
                        ['_controller' => [$controllerClass, $method->getName()]],
                        [],
                        [],
                        '',
                        [],
                        $routeAttr->methods
                    ));
                }
            }
        }

        return $routes;
    }
}