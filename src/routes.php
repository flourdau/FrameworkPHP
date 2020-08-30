<?php

use Symfony\Component\Routing;
use App\Controller\GreetingController;

$routes = new Routing\RouteCollection();

$routes->add('hello', new Routing\Route('/hello/{name}', [
    'name' => 'World',
    '_controller' => [new GreetingController, 'hello']
]));

$routes->add('bye', new Routing\Route('/bye', [
    '_controller' => [new GreetingController, 'bye']
]));

return $routes;