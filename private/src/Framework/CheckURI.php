<?php
namespace App\Framework;

use Symfony\Component\HttpFoundation\RedirectResponse;

class CheckURI
{
    public function scan(string $uri) : ?RedirectResponse 
    {
    // DELETE '/'
        if (!empty($uri) && $uri[-1] === '/' && strlen($uri) > 1) {
            if ($uri === str_repeat('/', strlen($uri))) {
                $response = new RedirectResponse('/', 301);
            } else {
                $response = new RedirectResponse(rtrim($uri, '/'), 301);
            }
            $response->send();
        } elseif (!empty($uri) && $uri === '/home') {
    // REDIRRECTION /Home -> /
            $response = new RedirectResponse('/', 301);
            $response->send();
        }
        return null;
    }
}
