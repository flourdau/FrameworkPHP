<?php
namespace App\Modules\Client\Controller;

use Symfony\Component\HttpFoundation;

class ClientController
{
    public function index(HttpFoundation\Request $request, $twig)
    {
        extract($request->attributes->all(), EXTR_SKIP);
        return (
            new HttpFoundation\Response($twig->render("Views/" . $_route . '.html.twig', [
                'title' => $app,
                'ip' => $request->getClientIp(),
                'user_agent'=> $request->headers->get('User-Agent')])));
    }
}
