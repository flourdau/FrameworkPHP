<?php
namespace App\Debug\Model;

use App\LibPHP\Debug;

class GetInfo
{
    private $html = [];

    public function __construct()
    {
        $this->html = new Debug;
        $this->get();
    }

    public function get()
    {
        return $this->html;
    }
}
