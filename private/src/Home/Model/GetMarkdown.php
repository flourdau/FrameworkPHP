<?php
namespace App\Home\Model;

class GetMarkdown
{
    private $html;

    public function __construct()
    {
        $this->html =  file_get_contents(__DIR__ . "/../../../../README.md", "r");
    }

    public function get()
    {
        return  $this->html;
    }
}
