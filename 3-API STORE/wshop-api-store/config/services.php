<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return function (ContainerConfigurator $configurator) {


    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();

    // Auto-load des Controllers (public)
    $services->load('App\\Controller\\', '../src/Controller/*')
        ->public();

    // Auto-load des Services (private)
    $services->load('App\\Service\\', '../src/Service/*');

    // Auto-load des Repositories (private)
    $services->load('App\\Repository\\', '../src/Repository/*');

    // Alias des Interfaces vers leur Implémentation
    $services->alias(App\Repository\StoreRepositoryInterface::class, App\Repository\StoreRepository::class);

    // Utiliser une méthode de fabrique pour récupérer la connexion
    $services->set(App\Infrastructure\Database\DatabaseConnectionInterface::class)
        ->factory([App\Infrastructure\Database\DatabaseConnectionManager::class, 'getConnection']);
};