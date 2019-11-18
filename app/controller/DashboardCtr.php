<?php

namespace app\controller;

use core\mvc\Controller;
use app\view\dashboard\DashboardView;
use core\dao\Connection;

class DashboardCtr extends Controller
{

    private $newDashView;
    private $session;
    public function __construct()
    {
        parent::__construct();

        $this->session = session_start();
        $this->newDashView = new DashboardView();
        $this->connection = Connection::getConnection();
    }

    public function showView()
    {
        $this->newDashView->show();
    }
    public function getModelFromView()
    { }
}
