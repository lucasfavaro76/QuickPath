<?php


namespace app\controller;

use core\mvc\Controller;

use core\Application;
use core\mvc\view\Message;

use app\view\dashboard\DashboardView;
use core\dao\Connection;
use app\dao\NumMesaDao;
use app\model\NumMesaModel;
use app\view\num_mesa\NumMesaView;
use core\util\Session;

class NumMesaCtr extends Controller
{

    private $action; //..determine if show NewUserView or UserView
    private $session;

    public function __construct()
    {
        parent::__construct();
        $this->session = session_start();
        $this->view = new NumMesaView();
        $this->connection = Connection::getConnection();
        //..verify if show a view do perform a new user or update a user
        $this->action = isset($this->get['action']) ? $this->get['action'] : 'update';
    }

    public function showView()
    {
        if ($this->action == 'new') {
            $this->view->show();
        } else
            parent::showView();
    }

    public function getModelFromView()
    {
        if (!empty($this->post)) {
            return new NumMesaModel(
                $this->post['id'],
                $this->post['numero_mesa'],
                Session::getSession('active_user')->getId()
            );
        }
    }

    public function insertUpdate()
    {
        if ($this->get['action'] == 'new') {
            try {

                $model = $this->getModelFromView();

                $num_mesa = new NumMesaDao($this->connection);
                $num_mesa->insert($model);

                $dash = new DashboardView;
                $dash->setMsg("Cadastro efetuado com sucesso!!!");
                $dash->show();
            } catch (\Exception $ex) {
                $dash = new DashboardView;
                $dash->setMsg("Problemas ao cadastrar mesa!! Erro:" . $ex);
                $dash->show();
            }
        } else {
            parent::insertUpdate();
        }
    }
}
