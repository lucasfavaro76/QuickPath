<?php


namespace app\controller;

use core\mvc\Controller;

use core\Application;
use core\mvc\view\Message;

use app\view\dashboard\DashboardView;
use core\dao\Connection;
use app\dao\NumMesaDao;
use app\dao\PessoaJuridicaDao;
use app\model\NumMesaModel;
use app\view\num_mesa\NumMesaView;
use app\view\restaurante\DescRestView;
use core\util\Session;

class DescCtr extends Controller
{

    private $session;
    private $id;

    public function __construct()
    {
        parent::__construct();
        
        $this->session = session_start();
        $this->view = new DescRestView();
        $this->connection = Connection::getConnection();
    }

    public function showView()
    {   
        $this->id = $this->get['rest'];
        $this->view->showRest($this->id); 
        $this->view->showProd($this->id);
        $this->view->showMesas($this->id);
        $this->view->Categorias($this->id);   
        $this->view->show();
    }
    public function getModelFromView()
    { }
}
