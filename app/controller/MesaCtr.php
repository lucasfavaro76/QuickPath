<?php


namespace app\controller;

use app\dao\MesaDao;
use core\mvc\Controller;
use core\dao\Connection;
use app\dao\NumMesaDao;
use app\model\MesaModel;
use app\model\NumMesaModel;
use app\model\PessoaModel;
use app\view\num_mesa\MesaView;
use app\view\num_mesa\NumMesaView;
use app\view\num_mesa\UpNumMesa;
use app\view\restaurante\DescRestView;
use core\util\Session;

class MesaCtr extends Controller
{

    private $action;
    private $session;
    private $mesa;
    protected $up_mesa;
    protected $dao;
    protected $ctr;
    protected $connection;

    public function __construct()
    {
        parent::__construct();
        $this->connection = Connection::getConnection();
        $this->session = session_start();
        $this->mesa = new MesaView();
        $this->view = new DescRestView();
      
        $this->up_mesa = new UpNumMesa();
        $this->dao = new MesaDao($this->connection);

        $this->connection = Connection::getConnection();
        //..verify if show a view do perform a new user or update a user
        $this->action = isset($this->get['action']) ? $this->get['action'] : '';
    }

    public function showView()
    {
        if ($this->action == 'new') {
            $this->view->show();
        } else if ($this->action == 'show') {
            $mesa = $this->dao->select("id_restaurante = " . Session::getSession('active_user')->getId());
            $this->mesa->setMesas($mesa);
            $this->mesa->show();
        } else {
            $id = $this->get['id'];
            $mesa = $this->dao->findById($id);
            $this->up_mesa->setNum_mesa($mesa);
            $this->up_mesa->show();
        }
    }

    public function getModelFromView()
    {
        if (!empty($this->post)) {
            return new MesaModel(
                $this->post['id'],
                new NumMesaModel($this->post["numero_mesa"], "", $this->post['id_restaurante'], "O"),
                null,
                new PessoaModel(Session::getSession('active_user')->getId()) ,
                $this->post['id_restaurante']
            );
        }
    }

    public function insertUpdate()
    {
        if ($this->get['action'] == 'new') {
            try {

                $model = $this->getModelFromView();

                $num_mesa = new MesaDao($this->connection);
                $num_mesa->insert($model);



                $this->view->setMsg("Mesa reservada com sucesso!!!");
                //$this->action = "show";
               header('Location: Request.php?class=DescCtr&method=showView&rest='. $model->getId_restaurante());

            } catch (\Exception $ex) {

                header("Request.php?class=DescCtr&method=showView&rest". $model->getId_restaurante());
            }
        } else {
            try {

                $model = $this->getModelFromView();
                $this->dao->update($model);

                $this->mesa->setMsg("Mesa alterada com sucesso");
                $this->action = "show";
                $this->showView();
            } catch (\Throwable $th) {

                $this->mesa->setMsg("Problemas ao alterar mesa " . $th);
                $this->action = "show";
                $this->showView();
            }
        }
    }

    public function delete()
    {
        try {
            if (isset($this->get['id'])) {
                $id = $this->get['id'];
                $result = (new NumMesaDao($this->connection))->delete($id);


                $this->mesa->setMsg("Mesa deletada com sucesso!!!");
                $this->action = "show";
                $this->showView();
            }
        } catch (\Throwable $th) {
            $this->nesa->setMsg("Erro ao deletar Mesa!!");
            $this->action = "show";
            $this->showView();
        }
    }
}
