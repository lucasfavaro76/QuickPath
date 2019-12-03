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
use app\view\produto\NewProdutoView;
use app\view\produto\ProdutoView;
use app\view\produto\UpProduto;

class ProdutoCtr extends Controller
{
    private $action; //..determine if show NewUserView or UserView
    private $prodView;
    private $prod;
    private $session;
    protected $dao;
    protected $upprod;

    public function __construct()
    {
        parent::__construct();
        isset($_SESSION['active_user']) ? $this->session = null : $this->session = session_start();
        $this->prodView = new NewProdutoView;
        $this->prod = new ProdutoView();
        $this->upprod =  new UpProduto();
        $this->connection = Connection::getConnection();
        $this->dao = new ProdutoDao($this->connection);
        $this->action = isset($this->get['action']) ? $this->get['action'] : '';
    }

    public function showView()
    {

        if ($this->action == 'new') {
            $this->prodView->show();
        } else if ($this->action == 'show') {
            $prod = (new ProdutoDao($this->connection))->select("p.id_restaurante = " . Session::getSession('active_user')->getId());
            $this->prod->setProduto($prod);
            $this->prod->show();
        }else{
            $cat = (new CategoriaDao($this->connection))->select("id_restaurante = " . Session::getSession('active_user')->getId());
            $this->upprod->setCategoria($cat);

            $id = $this->get['id'];
            $prod = $this->dao->findById($id);
            $this->upprod->setProduto($prod);

            $this->upprod->show();

        }
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
                $this->post['quant_estoque'],
                $this->post['image'] == "" ? $this->post['caminho'] : $this->post['image'] 
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


                $this->prodView->setMsg("Produto cadastrado com sucesso!!!");            
                $this->showView();
                
            } catch (\Exception $ex) {

                $this->prodView->setMsg("Problemas ao cadastrar produto!!!");                
                $this->showView();
            }
        } else {
            try {

                $model = $this->getModelFromView();

                $produto = new ProdutoDao($this->connection);
                $produto->update($model);


                $this->prod->setMsg("Produto cadastrado com sucesso!!!");
                $this->action = "show";
                $this->showView();
                
            } catch (\Exception $ex) {

                $this->prod->setMsg("Problemas ao cadastrar produto!!!");
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
                (new ProdutoDao($this->connection))->delete($id);

                $this->prod->setMsg("Produto deletado com sucesso!!!");
                $this->action = "show";
                $this->showView();
            }
        } catch (\Throwable $th) {
            if ($th->getCode() == 23503) {
                $this->prod->setMsg("Essa Produto esta ligada a uma venda!!!");
                $this->action = "show";
                $this->showView();
            } else {
                $this->prod->setMsg("Erro ao deletar Produto!!!");
                $this->action = "show";
                $this->showView();
            }
        }
    }
}
