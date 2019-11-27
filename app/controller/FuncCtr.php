<?php

namespace app\controller;

use app\dao\FuncionarioDao;
use core\mvc\Controller;

use app\view\funcionario\FuncionarioView;
use app\view\funcionario\NewFuncionarioView;
use core\dao\Connection;

class FuncCtr extends Controller
{

    protected $viewFunc;
    protected $dao;
    protected $func;
    protected $session;
    protected $connection;
    public function __construct()
    {
        parent::__construct();
        $this->connection = Connection::getConnection();
        $this->dao = new FuncionarioDao($this->connection);
        $this->session = session_start();
        $this->func = new FuncionarioView();
        $this->viewFunc = new NewFuncionarioView();
       
    }

    public function showView()
    {
        $this->viewFunc->show();
    }

    public function func()
    {
        $this->func->show();
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
                //..set the variable to show a javascript alert in client.           
                //..in this case, our view will be loaded after the insertion, because a list with current date flow must be show.
                $this->func->setMsg("Funcionario inativado");
                //..show the view
                $this->func();
            }
        } catch (\Exception $ex) {
            $this->func->setMsg("Erro ao inativar funcionario");
            //..show the view
            $this->func();
        }
    }
}
