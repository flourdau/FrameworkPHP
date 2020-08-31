<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\DependencyInjection\Reference;
    use App\Framework;
    use Symfony\Component\HttpKernel;

    $container = include __DIR__ . '/../private/src/Framework/container.php';
    $container->setParameter('routes', include __DIR__ . '/../private/src/Framework/routing.php');
    $container->setParameter('debug', true);
    $container->register('listener.response', HttpKernel\EventListener\ResponseListener::class)
        ->setArguments(['%charset%']);
    $container->setParameter('charset', 'UTF-8');
    $container->register('listener.string_response', Framework\StringResponseListener::class);
    $container->getDefinition('dispatcher')
        ->addMethodCall('addSubscriber', [new Reference('listener.string_response')]);

    $request = Request::createFromGlobals();
    $response = $container->get('kernel')->handle($request);
    $response->send();
