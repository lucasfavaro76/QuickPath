<?php

namespace app\view\restaurante;


use core\mvc\view\HtmlPage;
use core\dao\Connection;


final class RestDados extends HtmlPage
{

    protected $dados;
    protected $msg;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
        $this->htmlFile = 'app/view/restaurante/rest_dados.phtml';
    }

    public function renderHeader()
    {
        require_once('core\mvc\view\header_dashboard.phtml');
    }

    /**
     * Get the value of dados
     */
    public function getDados()
    {
        return $this->dados;
    }

    /**
     * Set the value of dados
     *
     * @return  self
     */
    public function setDados($dados)
    {
        $this->dados = $dados;

        return $this;
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
