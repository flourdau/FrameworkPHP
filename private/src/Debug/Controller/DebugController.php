<?php
namespace App\Debug\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Debug\Model\GetInfo;
use App\LibPHP\Debug;

class DebugController
{
    public function index(Request $request, $twig)
    {
        $tab = new Debug;
        extract($request->attributes->all(), EXTR_SKIP);
        return new Response($twig->render($_route . '.html.twig', [
                'title'     =>  $app,
                'debug'  =>  $tab->getTab()
                ]));
    }
}
