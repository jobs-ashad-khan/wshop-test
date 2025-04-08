<?php

namespace App\Rooting;

use App\Attribute\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route as SymfonyRoute;

class AttributeRouteLoader
{
    public static function load(array $controllers): RouteCollection
    {
        $routes = new RouteCollection();

        foreach ($controllers as $controllerClass) {
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