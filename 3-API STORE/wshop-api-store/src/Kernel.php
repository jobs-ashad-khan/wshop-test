<?php

namespace App;

use Symfony\Component\Dotenv\Dotenv;

class Kernel
{
    public static function boot()
    {
        $dotenv = new Dotenv();
        $dotenv->loadEnv(__DIR__.'/../.env');
    }
}