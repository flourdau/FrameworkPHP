<?php
namespace App\Home\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Home\Model\GetMarkdown;

class HomeController
{
    public function index(Request $request, $twig)
    {
        $html = new GetMarkdown();
        extract($request->attributes->all(), EXTR_SKIP);

        return new Response($twig->render($_route . '.html.twig', [
                'name'     =>  ucfirst($name),
                'title'     =>  $app,
                'markdown'  =>  $html->get()]));
    }
}
