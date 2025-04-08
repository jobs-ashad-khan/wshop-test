<?php

namespace App\Framework;

use App\Controller\StoreController;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ContainerFactory
{
    public static function create(): ContainerBuilder
    {
        $container = new ContainerBuilder();

        $container->register(StoreController::class, StoreController::class)
            ->addArgument([]);

        return $container;
    }
}