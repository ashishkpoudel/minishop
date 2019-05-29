<?php

/**
 * Application starting point - project made for pagevamp
 * Individual symphony components are used and glued up together
 */

// header("Access-Control-Allow-Origin: *"); // CORS related fix temp..
// header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, PATCH, OPTIONS");
// header("Access-Control-Allow-Headers:origin, content-type, accept");

require_once sprintf("%s/vendor/autoload.php", __DIR__);
require_once sprintf("%s/bootstrap/Framework.php", __DIR__);

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;

$routes = new RouteCollection();

require_once sprintf("%s/config/routes.php", __DIR__); // routes file

$request = Request::createFromGlobals();

$context = new RequestContext();

$framework = new Framework($routes);
$response = $framework->handle($request);
$response->headers->set('Access-Control-Allow-Origin' , '*', true);
$response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, DELETE, OPTIONS, HEAD', true);
$response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With', true);

if ($request->getMethod() == 'OPTIONS') {
    $response->setStatusCode(200);
    $response->setContent(null);
}

return $response->send();