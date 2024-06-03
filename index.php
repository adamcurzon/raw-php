<?php

namespace App;

use App\Http\Request;
use App\Http\Response;
use App\Enum\ResponseCode;

include_once "vendor/autoload.php";

include_once "container.php";
include_once "dependencies.php";
include_once "routes.php";

$request = new Request();
$request->parseUrl();

// Check the route
if (!array_key_exists($_SERVER["REQUEST_URI"], ROUTES)) {
    (new Response(ResponseCode::NOT_FOUND, "Route not found"))->send();
}

// Check the method
if (!array_key_exists($_SERVER["REQUEST_METHOD"], ROUTES[$_SERVER["REQUEST_URI"]])) {
    (new Response(ResponseCode::METHOD_NOT_ALLOWED, "Method not allowed"))->send();
}

// Handle the method
try {
    $route = ROUTES[$_SERVER["REQUEST_URI"]][$_SERVER["REQUEST_METHOD"]];
    $response = $container->get($route["controller"])->{$route["function"]}($request);

    $response->send();
} catch (\Exception $e) {
    throw $e;
    ($container->get("LoggerService"))->error($e->getMessage());
    (new Response(ResponseCode::SERVER_ERROR, $e->getMessage()))->send();
}
