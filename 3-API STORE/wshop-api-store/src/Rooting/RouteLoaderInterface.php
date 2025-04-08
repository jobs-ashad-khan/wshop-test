<?php

namespace App\Rooting;

use Symfony\Component\Routing\RouteCollection;

interface RouteLoaderInterface
{
    public function getRoutes(): RouteCollection;
}