<?php


namespace app\controller;

use core\mvc\Controller;

use core\Application;
use core\mvc\view\Message;

use app\view\dashboard\DashboardView;
use core\dao\Connection;
use app\dao\NumMesaDao;
use app\model\NumMesaModel;
use app\view\num_mesa\MesaView;
use app\view\num_mesa\NumMesaView;
use app\view\num_mesa\UpNumMesa;
use core\util\Session;

class NumMesaCtr extends Controller
{

    private $action; //..determine if show NewUserView or UserView
    private $session;
    private $mesa;
    protected $up_mesa;
    protected $dao;
    protected $connection;

    public function __construct()
    {
        parent::__construct();
        $this->connection = Connection::getConnection();
        $this->session = session_start();
        $this->mesa = new MesaView();
        $this->view = new NumMesaView();
        $this->up_mesa = new UpNumMesa();
        $this->dao = new NumMesaDao($this->connection);

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
            if (isset($this->post['intervalo'])) {

                $intervalo = $this->post['intervalo'];

                if ($intervalo == 0) {
                    $mesa = $this->post['numero_mesa'];
                } else {
                    $mesa = $this->post['intervalo'];
                }
            } else {
                $mesa = $this->post['numero_mesa'];
            }
            return new NumMesaModel(
                $this->post['id'],
                $mesa,
                Session::getSession('active_user')->getId(),
                "L"
            );
        }
    }

    public function insertUpdate()
    {
        if ($this->get['action'] == 'new') {
            try {

                $model = $this->getModelFromView();


                $tipo = $this->get['tipo'];

                $num_mesa = new NumMesaDao($this->connection);
                $num_mesa->insert($model, $tipo);



                $this->mesa->setMsg("Cadastro efetuado com sucesso!!!");
                $this->action = "show";
                $this->showView();
            } catch (\Exception $ex) {
                $this->mesa->setMsg("Problemas ao efetuar o cadastro!!!");
                $this->action = "show";
                $this->showView();
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
            if ($th->getCode() == 23503) {
                $this->mesa->setMsg("Essa mesa ja esta reservada nao é possivel apaga-la!!");
                $this->action = "show";
                $this->showView();
            } else {
                $this->mesa->setMsg("Erro ao deletar Mesa!!");
                $this->action = "show";
                $this->showView();
            }
        }
    }
}
