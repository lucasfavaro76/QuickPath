<?php
namespace app\view;

use core\mvc\view\HtmlPage;


final class Home extends HtmlPage
{
    public function __construct()
    {
        $this->htmlFile = 'app/view/home.phtml';
    }
}
