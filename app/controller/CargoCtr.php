<?php


namespace app\controller;

use core\mvc\Controller;
use core\util\Session;
use core\dao\Connection;
use app\model\CargoModel;
use app\dao\CargoDao;
use app\view\cargo\CargoView;
use app\view\cargo\NewCargoView;
use app\view\cargo\UpCargo;

class CargoCtr extends Controller
{

    private $cargoView;
    protected $cargo;
    private $session;
    protected $dao;
    protected $upcargo;

    public function __construct()
    {
        parent::__construct();
        $this->session = session_start();
        $this->cargoView = new NewCargoView();
        $this->cargo = new CargoView();
        $this->upcargo = new UpCargo();
        $this->connection = Connection::getConnection();
        $this->dao = new CargoDao($this->connection);
        //..verify if show a view do perform a new user or update a user
        $this->action = isset($this->get['action']) ? $this->get['action'] : '';
    }

    public function showView()
    {
        if ($this->action == 'new') {
            $this->cargoView->show();
        } else if ($this->action == 'show') {
            $cargo = $this->dao->select("id_restaurante = " . Session::getSession('active_user')->getId());
            $this->cargo->setCargos($cargo);
            $this->cargo->show();
        }else{
            $id = $this->get['id'];
            $cargos = $this->dao->findById($id);
            $this->upcargo->setCargo($cargos);
            $this->upcargo->show();
        }
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

                $this->cargoView->setMsg("Cargo cadastrado com sucesso!!!");
                $this->action = "new";
                $this->showView();
            } catch (\Exception $ex) {

                $this->cargoView->setMsg("Problemas ao cadastrar cargo" . $ex);
                $this->action = "new";
                $this->showView();
            }
        } else {
            try {
                $model = $this->getModelFromView();
                $this->dao->update($model);

                $this->cargo->setMsg("Cargo alterado com sucesso");

                $this->action = "show";
                $this->showView();
            } catch (\Throwable $th) {

                $this->cargo->setMsg("Problemas ao alterar cargo");

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

                $this->dao->delete($id);


                $this->cargo->setMsg("Cargo deletado com sucesso!!!");
                $this->action = "show";
                $this->showView();
            }
        } catch (\Throwable $th) {
            
            if ($th->getCode() == 23503) {
                $this->cargo->setMsg("Essa cargo ja esta ligado a um funcionario!!!");
                $this->action = "show";
                $this->showView();
            } else {
                $this->cat->setMsg("Erro ao deletar cargo!!!");
                $this->action = "show";
                $this->showView();
            }
        }
    }
}
