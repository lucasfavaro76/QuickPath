<?php

namespace app\view\num_mesa;

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
        $this->showMesas();
        $this->htmlFile = 'app/view/num_mesa/mesa_view.phtml';
    }

    public function renderHeader()
    {
        require_once('core\mvc\view\header_dashboard.phtml');
    }

    public function showMesas()
    {
        $mesa = (new NumMesaDao($this->connection))->select("id_restaurante = " . Session::getSession('active_user')->getId());
        $this->setMesas($mesa);
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
