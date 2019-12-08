<?php

namespace app\view\funcionario;

use app\dao\CargoDao;
use core\mvc\view\HtmlPage;
use core\dao\Connection;
use core\util\Session;

final class UpFuncionario extends HtmlPage
{

    protected $cargo;
    protected $funcionario;
    protected $msg;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
        $this->showCargo();
        $this->htmlFile = 'app/view/funcionario/up_funcionario.phtml';
    }

    public function renderHeader()
    {
        require_once('core\mvc\view\header_dashboard.phtml');
    }

    public function show()
    {
        $this->renderHeader();
        require_once($this->htmlFile);
        $this->renderFooter();
    }

    public function showCargo()
    {
        $cargo = (new CargoDao($this->connection))->select('id_restaurante = ' . Session::getSession('active_user')->getId());
        $this->setCargo($cargo);
    }

    /**
     * Get the value of cargo
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set the value of cargo
     *
     * @return  self
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
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
     * Get the value of funcionario
     */ 
    public function getFuncionario()
    {
        return $this->funcionario;
    }

    /**
     * Set the value of funcionario
     *
     * @return  self
     */ 
    public function setFuncionario($funcionario)
    {
        $this->funcionario = $funcionario;

        return $this;
    }
}
