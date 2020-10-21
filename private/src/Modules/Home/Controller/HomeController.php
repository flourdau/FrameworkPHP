<?php
namespace App\Modules\Home\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Lib;

class HomeController
{
    public function index(Request $request, $twig)
    {
        
        extract($request->attributes->all(), EXTR_SKIP);
        $name = Lib\MyLib::loopTxt2ASCII($_route . " " . $name . "!");
        // Lib\Debug::printDebug($name);
        // die;
        return new Response($twig->render("Views/" . $_route . '.html.twig', [
                'name'     =>  ucfirst($name),
                'title'     =>  $app]));
    }
}
