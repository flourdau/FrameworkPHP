<?php
    namespace App\Home\Controller;

    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    class HomeController {

        public function index(Request $request) {
            extract($request->attributes->all(), EXTR_SKIP);
            ob_start();
            include sprintf(__DIR__ . '/../../../templates/%s.php', $_route);
    
            return new Response(ob_get_clean());
        }

    }