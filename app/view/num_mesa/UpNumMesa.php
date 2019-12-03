<?php

namespace app\view\num_mesa;

use app\dao\CategoriaDao;

use core\dao\Connection;
use core\mvc\view\HtmlPage;


final class UpNumMesa extends HtmlPage
{

   
    protected $num_mesa;
    protected $msg;
    //protected $session;

    public function __construct()
    {
        //$this->session = session_start();
        $this->connection = Connection::getConnection();        
        $this->htmlFile = 'app/view/num_mesa/up_num_mesa.phtml';
    }

    public function renderHeader()
    {
        require_once('core\mvc\view\header_dashboard.phtml');
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


    /**
     * Get the value of num_mesa
     */ 
    public function getNum_mesa()
    {
        return $this->num_mesa;
    }

    /**
     * Set the value of num_mesa
     *
     * @return  self
     */ 
    public function setNum_mesa($num_mesa)
    {
        $this->num_mesa = $num_mesa;

        return $this;
    }
}
