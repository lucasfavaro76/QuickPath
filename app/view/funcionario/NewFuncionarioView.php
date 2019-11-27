<?php

namespace app\view\funcionario;

use app\dao\CargoDao;
use app\dao\PessoaJuridicaDao;
use core\mvc\view\HtmlPage;
use app\model\FuncionarioModel;
use app\model\PessoaModel;
use core\dao\Connection;
use core\util\Session;

final class NewFuncionarioView extends HtmlPage
{

    protected $cargo;
    protected $Juridica;
    protected $msg;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
        $this->showCargo();
        $this->htmlFile = 'app/view/funcionario/new_funcionario_view.phtml';
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
     * Get the value of Juridica
     */
    public function getJuridica()
    {
        return $this->Juridica;
    }

    /**
     * Set the value of Juridica
     *
     * @return  self
     */
    public function setJuridica($Juridica)
    {
        $this->Juridica = $Juridica;

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
