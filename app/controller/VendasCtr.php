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
use app\model\VendasModel;

class VendasCtr extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->connection = Connection::getConnection();       
    }

    // public function showView()
    // {
    //     if ($this->action == 'new') {
    //         $this->newUserView->show();
    //     } else
    //         parent::showView();
    // }

    public function getModelFromView()
    {
        if (!empty($this->post)) {
            return new VendasModel(
                $this->post['id'],
                $this->post['preco_total'],
                $this->post['data_venda'],
                $this->post['hora_venda'],
                $this->post['tipo_pagamento'],
                $this->post['id_funcionario'],
                $this->post['id_restaurante'],
                $this->post['id_pessoa'],
                $this->post['id_produto']
            );
        }
    }

    public function insertUpdate()
    {
        if ($this->get['action'] == 'new') {
            try {

                $model = $this->getModelFromView();
                $Venda = new VendasDao($this->connection);
                $Venda->insert($model);

                (new Message('Mensagem', 'Venda realizada com sucesso', Application::$ICON_SUCCESS))->show();
            } catch (\Exception $ex) {
                (new Message(null, Application::$MSG_ERROR, Application::$ICON_ERROR))->show();
            }
        } else {
            parent::insertUpdate();
        }
    }
}
