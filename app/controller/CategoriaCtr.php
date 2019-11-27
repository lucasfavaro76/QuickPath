<?php
namespace app\controller;

use core\mvc\Controller;
use app\dao\CategoriaDao;
use app\model\CategoriaModel;
use app\view\categoria\CategoriaView;
use app\view\dashboard\DashboardView;
use core\dao\Connection;
use core\util\Session;

final class CategoriaCtr extends Controller
{

    private $session;
    private $connection;

    public function __construct()
    {
        parent::__construct();        
        $this->session = session_start();
        $this->connection = Connection::getConnection();
        $this->dao = new CategoriaDao(); //..The DAO object
        $this->view = new CategoriaView(); //..the View Object 
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
        if (isset($this->post) && !empty($this->post)) {
            $id = (int)$this->post['id'];
            $nome_categoria = ltrim($this->post['nome_categoria']);
            return new CategoriaModel($id, $nome_categoria,Session::getSession('active_user')->getId());
        }
    }
    public function insertUpdate()
    {
        if ($this->get['action'] == 'new') {
            try {

                $model = $this->getModelFromView();
               
                    $categoria = new CategoriaDao($this->connection);
                    $categoria->insert($model);               
                
                    $cat = new CategoriaView();
                    $cat->setMsg("Categoria cadastrada com sucesso!!!");
                    $cat->show();
                    // $dash = new DashboardView;
                    // $dash->setMsg("");
                    // $dash->show();

            } catch (\Exception $ex) {                
                $dash = new DashboardView;
                $dash->setMsg("Problemas ao cadastrar categoria". $ex);
                $dash->show();
            }
        } else {
            parent::insertUpdate();
        }
    }   

}




