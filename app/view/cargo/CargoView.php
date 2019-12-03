<?php

namespace app\view\cargo;

use app\dao\CargoDao;
use app\dao\VendasDao;
use core\dao\Connection;
use core\mvc\view\HtmlPage;
use core\util\Session;

final class CargoView extends HtmlPage
{

    //protected $cargos;
    protected $msg;
    protected $session;

    public function __construct()
    {
        //$this->session = session_start();
        $this->connection = Connection::getConnection();
        
        $this->htmlFile = 'app/view/cargo/cargo_view.phtml';
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
     * Get the value of cargos
     */
    public function getCargos()
    {
        return $this->cargos;
    }

    /**
     * Set the value of cargos
     *
     * @return  self
     */
    public function setCargos($cargos)
    {
        $this->cargos = $cargos;

        return $this;
    }
}
