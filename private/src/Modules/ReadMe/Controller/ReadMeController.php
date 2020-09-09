<?php
namespace App\Modules\ReadMe\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Modules\ReadMe\Model\GetMarkdown;

class ReadMeController
{
    public function index(Request $request, $twig)
    {
        $html = new GetMarkdown();
        extract($request->attributes->all(), EXTR_SKIP);

        return new Response($twig->render("Views/" . $_route . '.html.twig', [
                'name'     =>  ucfirst($name),
                'title'     =>  $app,
                'markdown'  =>  $html->get()]));
    }
}
