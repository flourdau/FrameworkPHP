<?php
    use Symfony\Component\Routing;

    $routes = new Routing\RouteCollection();
    
    // //  HOMECONTROLLER :
    $routes->add('home', new Routing\Route('', ['_controller' => 'App\Home\Controller\HomeController::index']));
    

    // //  GREETINGCONTROLLER :
    $routes->add('hello', new Routing\Route('/hello/{name}', [
        'name' => 'World',
        '_controller' => 'App\Home\Controller\HomeController::index'
    ]));

    $routes->add('bye', new Routing\Route('/bye', ['_controller' => 'App\Home\Controller\HomeController::index']));
    
    $routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', [
        'year' => null,
        '_controller' => 'App\Calendar\Controller\LeapYearController::index',
    ]));
    
    
    return $routes;