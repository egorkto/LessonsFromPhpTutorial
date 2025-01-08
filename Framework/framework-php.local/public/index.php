<?php

define('BASE_PATH', dirname(__DIR__));

use Somecode\Framework\Http\Kernel;
use Somecode\Framework\Http\Request;

require_once BASE_PATH.'/vendor/autoload.php';

$requst = Request::createFromGlobals();

$content = '<h1>Hello</h1>';

$kernel = new Kernel;
$response = $kernel->handle($requst);

$response->send();
