<?php

namespace app\view\funcionario;

use app\dao\FuncionarioDao;
use core\dao\Connection;
use core\mvc\view\HtmlPage;
use core\util\Session;

final class FuncionarioView extends HtmlPage
{

    protected $msg;
    protected $funcs;
    protected $connection;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
        $this->showFuncs();
        $this->htmlFile = 'app/view/funcionario/funcionario_view.phtml';
    }

    public function renderHeader()
    {
        require_once('core\mvc\view\header_dashboard.phtml');
    }


    public function showFuncs()
    {
        $func = (new FuncionarioDao($this->connection))->select("id_restaurante = " . Session::getSession('active_user')->getId());
        $this->setFuncs($func);
    }

    /**
     * Get the value of funcs
     */
    public function getFuncs()
    {
        return $this->funcs;
    }

    /**
     * Set the value of funcs
     *
     * @return  self
     */
    public function setFuncs($funcs)
    {
        $this->funcs = $funcs;

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
}
