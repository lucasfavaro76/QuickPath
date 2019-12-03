<?php

namespace app\controller;

use core\mvc\Controller;
use app\dao\CategoriaDao;
use app\model\CategoriaModel;
use app\view\categoria\Categoria;
use app\view\categoria\CategoriaView;
use app\view\categoria\UpCategoria;
use app\view\dashboard\DashboardView;
use core\dao\Connection;
use core\util\Session;

final class CategoriaCtr extends Controller
{

    private $session;
    private $connection;
    private $cat;

    public function __construct()
    {
        parent::__construct();
        $this->session = session_start();
        $this->cat = new Categoria();
        $this->connection = Connection::getConnection();
        $this->dao = new CategoriaDao(); //..The DAO object
        $this->view = new CategoriaView(); //..the View Object 
        $this->upview = new UpCategoria();
        $this->action = isset($this->get['action']) ? $this->get['action'] : '';
    }

    public function showView()

    {
        if ($this->action == 'new') {
            $this->view->show();
        } else if ($this->action == 'show') {
            $cat = (new CategoriaDao($this->connection))->select("id_restaurante = " . Session::getSession('active_user')->getId());
            $this->cat->setCategoria($cat);
            $this->cat->show();
        } else {
            $id = $this->get['id'];
            $cat = (new CategoriaDao($this->connection))->findById($id);
            $this->upview->setCategoria($cat);
            $this->upview->show();
        }
    }

    public function getModelFromView()
    {
        if (isset($this->post) && !empty($this->post)) {
            $id = (int) $this->post['id'];
            $nome_categoria = ltrim($this->post['nome_categoria']);
            return new CategoriaModel($id, $nome_categoria, Session::getSession('active_user')->getId());
        }
    }
    public function insertUpdate()
    {
        if ($this->get['action'] == 'new') {
            try {

                $model = $this->getModelFromView();

                $categoria = new CategoriaDao($this->connection);
                $categoria->insert($model);

                $this->view->setMsg("Categoria cadastrada com sucesso!!!");                
                $this->showView();

            } catch (\Exception $ex) {

                $this->view->setMsg("Problemas ao cadastrar categoria" . $ex);
                
                $this->showView();
            }
        } else {
            try {
                $model = $this->getModelFromView();
                $this->dao->update($model);

                $this->cat->setMsg("Categoria alterada com sucesso");

                $this->action = "show";
                $this->showView();

            } catch (\Throwable $th) {
                $this->cat->setMsg("Problemas ao alterar categoria");

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
                $result = (new CategoriaDao($this->connection))->delete($id);


                $this->cat->setMsg("Categoria deletada com sucesso!!!");
                $this->action = "show";
                $this->showView();
            }
        } catch (\Throwable $th) {
            if ($th->getCode() == 23503) {
                $this->cat->setMsg("Essa categoria esta ligada a um produto!!!");
                $this->action = "show";
                $this->showView();
            } else {
                $this->cat->setMsg("Erro ao deletar categoria!!!");
                $this->action = "show";
                $this->showView();
            }
        }
    }
}
