<?php

require_once __DIR__ . '/../config/bootstrap.php';

use App\Kernel;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$response = new Kernel()->handle($request);

$response->send();