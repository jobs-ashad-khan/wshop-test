<?php

namespace App\Framework\DependencyInjection;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ServiceLoader
{
    public static function load(ContainerBuilder $container): void
    {
        self::registerFrom(__DIR__.'/../../Service', 'App\\Service\\', $container);
        self::registerFrom(__DIR__.'/../../Controller', 'App\\Controller\\', $container);
    }

    private static function registerFrom(string $path, string $namespacePrefix, ContainerBuilder $container): void
    {
        if (!file_exists($path)) {
            return;
        }

        $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));

        foreach ($rii as $file) {
            if (!$file->isFile() || $file->getExtension() !== 'php') {
                continue;
            }

            $relativePath = str_replace([$path . '/', '.php'], ['', ''], $file->getPathname());
            $className = $namespacePrefix . str_replace('/', '\\', $relativePath);

            if (!class_exists($className)) {
                require_once $file->getPathname();
            }

            if (!class_exists($className)) {
                continue;
            }

            $reflection = new ReflectionClass($className);

            if ($reflection->isInstantiable()) {
                $isController = str_contains($className, 'Controller');

                $container->register($className, $className)
                    ->setAutowired(true)
                    ->setPublic($isController);
            }
        }
    }
}