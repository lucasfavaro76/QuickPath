<?php


namespace app\controller;

use core\mvc\Controller;
use app\view\pessoa\NewUserView;
use app\view\pessoa\UserView;
use app\dao\PessoaDao;
use app\model\PessoaFisicaModel;
use app\model\PessoaJuridicaModel;
use app\model\PessoaModel;
use core\Application;
use core\mvc\view\Message;
use core\util\Session;
use app\view\Home;
use app\model\EnderecoModel;
use app\dao\PessoaFisicaDao;
use app\dao\PessoaJuridicaDao;
use app\view\dashboard\DashboardView;
use core\dao\Connection;
use app\model\FuncionarioModel;
use app\model\CargoModel;
use app\view\pessoa\NewFuncionarioView;
use app\dao\CargoDao;
use app\dao\FuncionarioDao;
use app\view\cargo\NewCargoView;

class CargoCtr extends Controller
{

    private $cargoView;
    private $session;

    public function __construct()
    {
        parent::__construct();
        $this->cargoView = new NewCargoView();
        $this->session = session_start();
        $this->connection = Connection::getConnection();
        //..verify if show a view do perform a new user or update a user
        $this->action = isset($this->get['action']) ? $this->get['action'] : 'update';
    }

    public function showView()
    {
        if ($this->action == 'new') {
            $this->cargoView->show();
        } else
            parent::showView();
    }

    public function getModelFromView()
    {
        if (!empty($this->post)) {

            return new CargoModel(
                $this->post['id'],
                $this->post['nome_cargo'],
                Session::getSession('active_user')->getId()
            );
        }
    }


    public function insertUpdate()
    {
        if ($this->get['action'] == 'new') {
            try {

                $model = $this->getModelFromView();


                $cargo = new CargoDao($this->connection);
                $cargo->insert($model);

                $cargo = new NewCargoView();
                $cargo->setMsg("Cargo cadastrado com sucesso!!!");
                $cargo->show();
            } catch (\Exception $ex) {
                $cargo = new NewCargoView();
                $cargo->setMsg("Problemas ao cadastrar cargo" . $ex);
                $cargo->show();
            }
        } else {
            parent::insertUpdate();
        }
    }
}
