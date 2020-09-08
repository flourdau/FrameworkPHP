<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel;
use Symfony\Component\Dotenv\Dotenv;
use App\Framework;

$request = Request::createFromGlobals();
(new Dotenv())->bootEnv(__DIR__ . '/../private/config/.env');

$container = include __DIR__ . '/../private/src/Framework/container.php';
$container->setParameter('routes', include __DIR__ . '/../private/src/Framework/routing.php');
$container->setParameter('debug', $_ENV['APP_DEBUG']);

$container->register('listener.response', HttpKernel\EventListener\ResponseListener::class)
    ->setArguments(['%charset%']);
$container->setParameter('charset', 'UTF-8');
$container->register('listener.string_response', Framework\StringResponseListener::class);
$container->getDefinition('dispatcher')
    ->addMethodCall('addSubscriber', [new Reference('listener.string_response')]);

$request->attributes->set("app", json_decode(file_get_contents(__DIR__ . "/../private/config/.app.json", "r"), true));
$request->attributes->set("twig", $container->get('env_twig'));

$container->get('kernel')->checkURI($request);

$container->get('kernel')->terminate($request, $container->get('kernel')->handle($request)->send());
