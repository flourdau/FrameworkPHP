<?php
    namespace App\Framework;

    use Symfony\Component\HttpKernel;
    
    class Kernel extends HttpKernel\HttpKernel {

        // public function __construct($routes) {

            // $context = new Routing\RequestContext();
            // $matcher = new Routing\Matcher\UrlMatcher($routes, $context);

            // $requestStack = new RequestStack();
            // $controllerResolver = new HttpKernel\Controller\ControllerResolver();
            // $argumentResolver = new HttpKernel\Controller\ArgumentResolver();
    
            // $dispatcher = new EventDispatcher();
            // $dispatcher->addSubscriber(new HttpKernel\EventListener\ErrorListener( 'App\Calendar\Controller\ErrorController::exception'));
            // $dispatcher->addSubscriber(new HttpKernel\EventListener\RouterListener($matcher, $requestStack));
            // $dispatcher->addSubscriber(new HttpKernel\EventListener\ResponseListener('UTF-8'));
            // $dispatcher->addSubscriber(new StringResponseListener());
            // $dispatcher->addSubscriber(new ContentLengthListener());
            // $dispatcher->addSubscriber(new GoogleListener());

            // $context =;
            // $matcher =;
            // $requestStack =;
            // $dispatcher =;

            // parent::__construct($dispatcher, $controllerResolver, $requestStack, $argumentResolver);
        
        // }

    }