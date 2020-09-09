<?php
use Symfony\Component\DependencyInjection;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\EventDispatcher;
use Symfony\Component\HttpFoundation;
use Symfony\Component\HttpKernel;
use Symfony\Component\Routing;
use Twig\Extra\Markdown\MarkdownExtension;

use App\Framework\Kernel;

$containerBuilder = new DependencyInjection\ContainerBuilder();

$containerBuilder->register('debug', $_ENV['APP_DEBUG']);
$containerBuilder->register('context', Routing\RequestContext::class);
$containerBuilder->register('matcher', Routing\Matcher\UrlMatcher::class)
    ->setArguments(['%routes%', new Reference('context')]);
$containerBuilder->register('checkURI', App\Framework\CheckURI::class);
    
$containerBuilder->register('loader_twig', Twig\Loader\FilesystemLoader::class)
    ->setArguments([__DIR__ . '/../../templates']);
$containerBuilder->register('twig.extension', MarkdownExtension::class);
$containerBuilder->register('twig.debug', Twig\Extension\DebugExtension::class);
$containerBuilder->register('twig.runtime', App\Framework\Runtime::class);


if (!$_ENV['APP_DEBUG']) {
    $containerBuilder->register('env_twig', Twig\Environment::class)
        ->setArguments([new Reference('loader_twig'), ['cache' => __DIR__ . '/../../cache/twig']])
        ->addMethodCall('addExtension', [new Reference('twig.extension')])
        ->addMethodCall('addRuntimeLoader', [new Reference('twig.runtime')]);
} else {
    $containerBuilder->register('env_twig', Twig\Environment::class)
        ->setArguments([new Reference('loader_twig'), ['debug' => true,'cache' => false]])
        ->addMethodCall('addExtension', [new Reference('twig.extension')])
        ->addMethodCall('addExtension', [new Reference('twig.debug')])
        ->addMethodCall('addRuntimeLoader', [new Reference('twig.runtime')]);
}

$containerBuilder->register('request_stack', HttpFoundation\RequestStack::class);
$containerBuilder->register('controller_resolver', HttpKernel\Controller\ControllerResolver::class);
$containerBuilder->register('argument_resolver', HttpKernel\Controller\ArgumentResolver::class);

$containerBuilder->register('listener.router', HttpKernel\EventListener\RouterListener::class)
    ->setArguments([new Reference('matcher'), new Reference('request_stack')]);
$containerBuilder->register('listener.response', HttpKernel\EventListener\ResponseListener::class)
    ->setArguments(['UTF-8']);
$containerBuilder->register('listener.exception', HttpKernel\EventListener\ErrorListener::class)
    ->setArguments(['App\Modules\Calendar\Controller\ErrorController::exception']);

$containerBuilder->register('dispatcher', EventDispatcher\EventDispatcher::class)
    ->addMethodCall('addSubscriber', [new Reference('listener.router')])
    ->addMethodCall('addSubscriber', [new Reference('listener.response')])
    ->addMethodCall('addSubscriber', [new Reference('listener.exception')]);

$containerBuilder->register('kernel', Kernel::class)
    ->setArguments([
        new Reference('dispatcher'),
        new Reference('controller_resolver'),
        new Reference('request_stack'),
        new Reference('argument_resolver')
    ]);

return $containerBuilder;
