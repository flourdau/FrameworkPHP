<?php
namespace App\Calendar\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Calendar\Model\LeapYear;

class LeapYearController
{
    public function index(Request $request, $twig)
    {
        extract($request->attributes->all(), EXTR_SKIP);
        $leapYear = new LeapYear();

        if ($leapYear->isLeapYear($year)) {
            $response = new Response($twig->render($_route . '.html.twig', [
                'year'  =>  $year,
                'msg'   =>  'Yep, ' . $year . ' this is a leap year!']));
        // Cache verification :
        // $response = new Response($twig->render($_route . '.html.twig', [
        //     'year'  =>  $year,
        //     'msg'   =>  'Yep, ' . $year . 'this is a leap year!' . rand()
        //     ]));
        } else {
            $response =  new Response($twig->render($_route . '.html.twig', [
                'year'  =>  $year,
                'msg'   =>  'Nope, ' . $year . ' this is not a leap year.']));
        }
        $response->setTtl(10);
        return $response;
    }
}
