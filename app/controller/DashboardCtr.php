<?php

namespace app\controller;

use app\dao\FuncionarioDao;
use app\dao\PessoaJuridicaDao;
use core\mvc\Controller;
use app\view\dashboard\DashboardView;
use app\view\restaurante\RestDados;
use app\view\restaurante\UpDadosRest;
use core\dao\Connection;
use core\util\Session;

class DashboardCtr extends Controller
{

    private $newDashView;
    private $session;
    protected $rest_dados;
    protected $action;
    protected $up_dados;

    public function __construct()
    {
        parent::__construct();

        isset($_SESSION['active_user']) ? $this->session = null : $this->session = session_start();
        $this->rest_dados = new RestDados();
        $this->newDashView = new DashboardView();
        $this->connection = Connection::getConnection();
        $this->up_dados = new UpDadosRest();
        $this->action = isset($this->get['action']) ? $this->get['action'] : '';
    }

    public function showView()
    {
        if ($this->action == "new") {
            $this->newDashView->showMesas();
            $this->newDashView->show();

        } else if ($this->action == "show"){
            $dados = (new PessoaJuridicaDao($this->connection))->findById(Session::getSession('active_user')->getId());
            $this->rest_dados->setDados($dados);
            $this->rest_dados->show();
        }else{
            $dados = (new PessoaJuridicaDao($this->connection))->findById(Session::getSession('active_user')->getId());
            $this->up_dados->setDados($dados);
            $this->up_dados->show();
        }
    }

        

    public function GerarPdf()
    {
        $this->newDashView->pdf();
    }

    public function getModelFromView()
    { }

    /**
     * Get the value of action
     */ 
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set the value of action
     *
     * @return  self
     */ 
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }
}
