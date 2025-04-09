<?php

namespace App\Infrastructure\Framework\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class ContainerFactory
{
    /**
     * @throws \Exception
     */
    public static function create(): ContainerBuilder
    {
        $container = new ContainerBuilder();

        $loader = new PhpFileLoader($container, new FileLocator(__DIR__ . '/../../../../config'));
        $loader->load('services.php');

        $container->compile();

        return $container;
    }
}