<?php

namespace app\view;

use app\dao\PessoaJuridicaDao;
use core\Application;
use core\dao\Connection;
use core\mvc\view\HtmlPage;
use core\mvc\view\Message;
use app\controller\PessoaCtr;

final class Home extends HtmlPage
{
    protected $restaurantes;
    public function __construct()
    {
        $this->htmlFile = 'app/view/home.phtml';
        $this->connection = Connection::getConnection();
        $this->showAll();
    }

    public function showAll()
    {
        $rest = new PessoaJuridicaDao($this->connection);
        $result = $rest->selectAll();
        if (empty($result)) {        
        } else {  
            $this->setRestaurantes($result);                
        }
    }

    /**
     * Get the value of restaurantes
     */ 
    public function getRestaurantes()
    {
        return $this->restaurantes;
    }

    /**
     * Set the value of restaurantes
     *
     * @return  self
     */ 
    public function setRestaurantes($restaurantes)
    {
        $this->restaurantes = $restaurantes;

        return $this;
    }
}
