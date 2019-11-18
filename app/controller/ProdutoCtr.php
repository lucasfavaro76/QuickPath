<?php

namespace app\controller;

use core\mvc\Controller;
use core\util\Session;
use app\view\dashboard\DashboardView;
use core\dao\Connection;
use app\dao\CategoriaDao;
use app\dao\ProdutoDao;
use app\model\CategoriaModel;
use app\model\ProdutoModel;
use app\view\produto\NewProdutoView as AppNewProdutoView;

class ProdutoCtr extends Controller
{
    private $action; //..determine if show NewUserView or UserView
    private $prodView;
    private $session;

    public function __construct()
    {
        parent::__construct();
        $this->session = session_start();
        $this->prodView = new AppNewProdutoView;
        $this->connection = Connection::getConnection();
        $this->action = isset($this->get['action']) ? $this->get['action'] : 'update';
    }

    public function showView()
    {

        if ($this->action == 'new') {
            $prod = new CategoriaDao();
            $result = $prod->select('id_restaurante = ' . Session::getSession('active_user')->getId());
            $this->prodView->setCategoria($result);
            $this->prodView->show();
        } else
            parent::showView();
    }

    public function getModelFromView()
    {
        if (!empty($this->post)) {
            return new ProdutoModel(
                $this->post['id'],
                $this->post['nome_produto'],
                $this->post['unidade_produto'],
                $this->post['preco_produto'],
                new CategoriaModel($this->post['categoria'], null),
                Session::getSession('active_user')->getId(),
                $this->post['quant_estoque']
            );
        }
    }

    public function insertUpdate()
    {
        if ($this->get['action'] == 'new') {
            try {

                $model = $this->getModelFromView();
                $produto = new ProdutoDao($this->connection);
                $produto->insert($model);

                $dash = new DashboardView;
                $dash->setMsg("Produto cadastrado com sucesso!!!");
                $dash->show();
            } catch (\Exception $ex) {
                $dash = new DashboardView;
                $dash->setMsg("Erro ao cadastrar Produto!!! Erro: ". $ex);
                $dash->show();
            }
        } else {
            parent::insertUpdate();
        }
    }
}
