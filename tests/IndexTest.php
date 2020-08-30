<?php
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexTest extends TestCase
{

    public function testHello()
    {

        $request = Request::create('/hello/Fabien');
        ob_start();
        include __DIR__ . '/../public/index.php';
        $response = new Response(ob_get_clean());
        
        $this->assertEquals('<h1>Hello Fabien!</h1>', $response->send());
    }

}