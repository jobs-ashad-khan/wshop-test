<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\Kernel;
use Symfony\Component\HttpFoundation\Request;

$routes = require __DIR__ . '/../config/routes.php';

$request = Request::createFromGlobals();

$response = new Kernel()->handle($request);

$response->send();