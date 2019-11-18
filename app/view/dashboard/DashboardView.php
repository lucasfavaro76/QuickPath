<?php

namespace app\view\dashboard;

use app\dao\PessoaJuridicaDao;
use app\dao\VendasDao;
use core\dao\Connection;
use core\mvc\view\HtmlPage;


final class DashboardView extends HtmlPage
{

    protected $vendas;
    protected $msg;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
        $this->htmlFile = 'app/view/dashboard/dashboard_view.phtml';
        $this->showVendas();
    }

   

    /**
     * Get the value of vendas
     */
    public function getVendas()
    {
        return $this->vendas;
    }

    /**
     * Set the value of vendas
     *
     * @return  self
     */
    public function setVendas($vendas)
    {
        $this->vendas = $vendas;

        return $this;
    }

    public function renderHeader()
    {
        require_once('core\mvc\view\header_dashboard.phtml');
    }

    public function renderFooter()
    {
        require_once('core\mvc\view\footer.phtml');
    }

    public function show()
    {
        $this->renderHeader();
        require_once($this->htmlFile);
        $this->renderFooter();
    }

    public function showVendas()
    {
        $rest = new VendasDao($this->connection);
        $result = $rest->select();
        $this->setVendas($result);
    }

    /**
     * Get the value of msg
     */ 
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * Set the value of msg
     *
     * @return  self
     */ 
    public function setMsg($msg)
    {
        $this->msg = $msg;

        return $this;
    }
}
