<?php

namespace app\view\produto;

use app\dao\ProdutoDao;
use core\dao\Connection;
use core\mvc\view\HtmlPage;
use core\util\Session;

final class ProdutoView extends HtmlPage
{

   
    protected $produto;
    protected $msg;
    //protected $session;

    public function __construct()
    {
        //$this->session = session_start();
        $this->connection = Connection::getConnection();
        
        $this->htmlFile = 'app/view/produto/produto_view.phtml';
    }

    public function renderHeader()
    {
        require_once('core\mvc\view\header_dashboard.phtml');
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


    /**
     * Get the value of produto
     */ 
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     * Set the value of produto
     *
     * @return  self
     */ 
    public function setProduto($produto)
    {
        $this->produto = $produto;

        return $this;
    }
}
