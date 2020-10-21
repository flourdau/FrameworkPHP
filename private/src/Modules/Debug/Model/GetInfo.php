<?php
namespace App\Modules\Debug\Model;

use App\Lib\Debug;

class GetInfo
{
    public $html = [];

    public function __construct()
    {
        $this->html = new Debug;
        $this->get();
    }

    public function get()
    {
        return $this->html->getTab();
    }
}
