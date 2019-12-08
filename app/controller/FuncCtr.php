<?php

namespace app\controller;

use app\dao\FuncionarioDao;
use core\mvc\Controller;

use app\view\funcionario\FuncionarioView;
use app\view\funcionario\NewFuncionarioView;
use app\view\funcionario\UpFuncionario;
use core\dao\Connection;
use core\util\Session;

class FuncCtr extends Controller
{

    protected $viewFunc;
    protected $dao;
    protected $func;
    protected $up_func;
    protected $session;
    protected $connection;
    protected $action;
    public function __construct()
    {
        parent::__construct();
        $this->connection = Connection::getConnection();
        $this->dao = new FuncionarioDao($this->connection);
        $this->session = isset($_SESSION) ? "" : session_start();
        $this->func = new FuncionarioView();
        $this->up_func = new UpFuncionario();
        $this->viewFunc = new NewFuncionarioView();
        $this->action = isset($this->get['action']) ? $this->get['action'] : '';
    }

    public function showView()
    {
        if ($this->action == "new") {
            $this->viewFunc->show();
        } else if ($this->action == "show") {
            $func = $this->dao->select("id_restaurante = " . Session::getSession('active_user')->getId());
            $this->func->setFuncs($func);
            $this->func->show();
        }else{
            $id = $this->get['id'];
            $func = $this->dao->findById($id);
            $this->up_func->setFuncionario($func);            
            $this->up_func->show();
        }
    }


    public function getModelFromView()
    { }

    public function delete()
    {
        try {
            //..if the post 'id' variable is not null, then get the variable and invokes the delete method of DAO object.
            if (!is_null($this->get['id'])) {
                $id = $this->get['id'];
                $this->dao->delete($id);


                $this->func->setMsg("Funcionario inativado");
                $this->action = "show";
                $this->showView();
            }
        } catch (\Exception $ex) {
            $this->func->setMsg("Erro ao inativar funcionario");
            $this->action = "show";
            $this->showView();
        }
    }

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
