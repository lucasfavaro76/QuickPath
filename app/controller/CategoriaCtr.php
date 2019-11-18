<?php
namespace app\controller;

use core\mvc\Controller;
use app\dao\CategoriaDao;
use app\model\CategoriaModel;
use app\view\category\CategoriaView;
use app\view\category\CategoriaList;

final class CategoriaCtr extends Controller
{

    public function __construct()
    {
        parent::__construct();        
        $this->dao = new CategoriaDao(); //..The DAO object
        $this->view = new CategoriaView(); //..the View Object
        $this->viewList = new CategoriaList(); //..the List View Object        
    }

    public function getModelFromView()
    {
        if (isset($this->post) && !empty($this->post)) {
            $id = (int)$this->post['id'];
            $nome_categoria = ltrim($this->post['nome_categoria']);
            return new CategoriaModel($id, $nome_categoria);
        }
    }
}




