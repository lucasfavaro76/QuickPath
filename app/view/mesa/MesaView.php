<?php

namespace app\view\mesa;

use app\dao\CargoDao;
use app\dao\NumMesaDao;
use app\dao\VendasDao;
use core\dao\Connection;
use core\mvc\view\HtmlPage;
use core\util\Session;

final class MesaView extends HtmlPage
{

    protected $mesas;
    protected $msg;
    protected $session;

    public function __construct()
    {
        //$this->session = session_start();
        $this->connection = Connection::getConnection();
        
        $this->htmlFile = 'app/view/mesa/mesa_view.phtml';
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
     * Get the value of mesas
     */ 
    public function getMesas()
    {
        return $this->mesas;
    }

    /**
     * Set the value of mesas
     *
     * @return  self
     */ 
    public function setMesas($mesas)
    {
        $this->mesas = $mesas;

        return $this;
    }
}
