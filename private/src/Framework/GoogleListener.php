<?php
    namespace App\Framework;

    use Symfony\Component\EventDispatcher\EventSubscriberInterface;

    class GoogleListener implements EventSubscriberInterface {

        public function onResponse(ResponseEvent $event) {

            $response = $event->getResponse();
    echo 'toto';
            if ($response->isRedirection() || ($response->headers->has('Content-Type') && false === strpos($response->headers->get('Content-Type'), 'html')) || 'html' !== $event->getRequest()->getRequestFormat()) {
                return;
            }
    
            $response->setContent($response->getContent().'<p>GA CODE</p>');
        }

        public static function getSubscribedEvents() {
            return ['response' => 'onResponse'];
        }

    }