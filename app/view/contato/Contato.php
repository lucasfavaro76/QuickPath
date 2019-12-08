<?php

namespace app\view\contato;

use core\mvc\view\HtmlPage;
use core\dao\Connection;


final class Contato extends HtmlPage
{

    protected $msg;

    public function __construct()
    {        
        $this->connection = Connection::getConnection();
        $this->htmlFile = 'app/view/contato/contato.phtml';
    }

    /**
     * Get the value of msg
     */ 
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * Set the value of msg
     *
     * @return  self
     */ 
    public function setMsg($msg)
    {
        $this->msg = $msg;

        return $this;
    }
}
