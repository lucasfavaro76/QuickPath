<?php


namespace app\controller;

use app\view\contato\Contato;
use core\mvc\Controller;
use core\dao\Connection;


class ContatoCtr extends Controller
{

    private $session;
    protected $view;
    private $id;

    public function __construct()
    {
        parent::__construct();        
        $this->session = isset($_SESSION) ? "" : session_start();
        $this->view = new Contato();
        $this->connection = Connection::getConnection();
    }

    public function showView()
    {            
        $this->view->show();
    }
    public function getModelFromView()
    { }
}
