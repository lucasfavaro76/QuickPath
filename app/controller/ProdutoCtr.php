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

                $prod = new AppNewProdutoView();
                $prod->setMsg("Produto cadastrado com sucesso!!!");
                $prod->show();
            } catch (\Exception $ex) {
                $prod = new AppNewProdutoView();
                $prod->setMsg("Problemas ao cadastrar produto!!!");
                $prod->show();
            }
        } else {
            parent::insertUpdate();
        }
    }
}
