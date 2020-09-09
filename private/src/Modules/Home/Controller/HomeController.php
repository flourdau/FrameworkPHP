<?php
namespace App\Modules\Home\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    public function index(Request $request, $twig)
    {
        extract($request->attributes->all(), EXTR_SKIP);

        return new Response($twig->render("Views/" . $_route . '.html.twig', [
                'name'     =>  ucfirst($name),
                'title'     =>  $app]));
    }
}
