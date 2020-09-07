<?php
use Symfony\Component\Routing;
use \Symfony\Component\HttpFoundation\RedirectResponse;

// DELETE '/'
// $uri = $request->getRequestUri();
// if (!empty($uri) && $uri[-1] === '/' && strlen($uri) > 1) {
//     $response = new RedirectResponse(substr($uri, 0, -1), 301);
//     $response->send();
// }

$routes = new Routing\RouteCollection();

//  HOMECONTROLLER :
$routes->add('home', new Routing\Route('/', [
    '_controller'   => 'App\Home\Controller\HomeController::index',
    'name'          =>  'World']));
$routes->add('home2', new Routing\Route('/home', [
    '_controller' => 'App\Home\Controller\HomeController::index',
    'name'          =>  'World']));

//  DEBUGCONTROLLER :
if ($_ENV{'APP_DEBUG'}) {
    $routes->add('debug', new Routing\Route('/debug', [
        '_controller' => 'App\Debug\Controller\DebugController::index']));
}

//  CLIENTCONTROLLER :
$routes->add('client', new Routing\Route('/client', [
    '_controller' => 'App\Client\Controller\ClientController::index']));

//  GREETINGCONTROLLER :
//  /hello
$routes->add('hello', new Routing\Route('/hello/{name}', [
    'name' => 'World',
    '_controller' => 'App\Home\Controller\HomeController::index']));
//  /bye
$routes->add('bye', new Routing\Route('/bye/{name}', [
    'name' => 'World',
    '_controller' => 'App\Home\Controller\HomeController::index']));

$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', [
    'year' => null,
    '_controller' => 'App\Calendar\Controller\LeapYearController::index']));
    
return $routes;
