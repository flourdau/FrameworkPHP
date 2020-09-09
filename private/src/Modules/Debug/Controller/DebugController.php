<?php
namespace App\Modules\Debug\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Modules\Debug\Model\GetInfo;

class DebugController
{
    public function index(Request $request, $twig)
    {
        $tab = new GetInfo;
        extract($request->attributes->all(), EXTR_SKIP);
        return new Response($twig->render("Views/" . $_route . '.html.twig', [
                'title'     =>  $app,
                'debug'  =>  $tab->get()
                ]));
    }
}
