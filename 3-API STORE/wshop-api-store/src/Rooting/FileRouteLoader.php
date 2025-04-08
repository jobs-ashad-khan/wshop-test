<?php

namespace App\Rooting;

use Symfony\Component\Routing\RouteCollection;

class FileRouteLoader implements RouteLoaderInterface
{

    public function getRoutes(): RouteCollection
    {
        return require __DIR__ . '/../../config/routes.php';
    }
}