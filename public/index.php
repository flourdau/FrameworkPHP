<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Routing\Exception\ResourceNotFoundException;

require_once __DIR__ . '/../vendor/autoload.php';

$request = Request::createFromGlobals();
$routes = require_once __DIR__ . '/../src/routes.php';
$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context->fromRequest($request));

try {
    $request->attributes->add($matcher->match($request->getPathInfo()));
    $response = call_user_func($request->attributes->get('_controller'), $request);
} catch (ResourceNotFoundException $e) {
    $response = new Response('Not Found', 404);
} catch (Exception $exception) {
    $response = new Response('An error occurred', 500);
}

$response->send();