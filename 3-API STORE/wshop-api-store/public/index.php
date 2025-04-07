<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\Kernel;

Kernel::boot();

$env = $_ENV['APP_ENV'] ?? 'dev';

if ($env === 'dev') {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
}