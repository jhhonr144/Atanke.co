<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));
 
/*
if (file_exists($maintenance = __DIR__.'/../../api/storage/framework/maintenance.php')) {
    require $maintenance;
}*/
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}
 

//require __DIR__.'/../../api/vendor/autoload.php';
require __DIR__.'/../vendor/autoload.php';


//$app = require_once __DIR__.'/../../api/bootstrap/app.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
