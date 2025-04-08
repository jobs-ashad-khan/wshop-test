<?php

namespace App\Framework\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;

class ContainerFactory
{
    public static function create(): ContainerBuilder
    {
        $container = new ContainerBuilder();

        ServiceLoader::load($container);

        $container->compile();

        return $container;
    }
}