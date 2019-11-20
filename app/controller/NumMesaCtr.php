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
            if ($this->post['intervalo'] != 0) {
                $mesa = $this->post['intervalo'];
            }else{
                $mesa = $this->post['numero_mesa'];
            }
            return new NumMesaModel(
                $this->post['id'],
                $mesa,                
                Session::getSession('active_user')->getId(), "L"
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
               

                $num_mesa = new NumMesaView();
                $num_mesa->setMsg("Cadastro efetuado com sucesso!!!");
                $num_mesa->show();
            } catch (\Exception $ex) {
                $num_mesa = new NumMesaView();
                $num_mesa->setMsg("Problemas ao efetuar o cadastro!!!");
                $num_mesa->show();
            }
        } else {
            parent::insertUpdate();
        }
    }
}
