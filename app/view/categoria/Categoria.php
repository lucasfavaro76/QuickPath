<?php

namespace app\view\categoria;

use app\dao\CategoriaDao;

use core\dao\Connection;
use core\mvc\view\HtmlPage;
use core\util\Session;

final class Categoria extends HtmlPage
{

   
    protected $categoria;
    protected $msg;
    //protected $session;

    public function __construct()
    {
        //$this->session = session_start();
        $this->connection = Connection::getConnection();
        $this->showCategoria();
        $this->htmlFile = 'app/view/categoria/show_categoria.phtml';
    }

    public function renderHeader()
    {
        require_once('core\mvc\view\header_dashboard.phtml');
    }

    public function showCategoria()
    {
        $cat = (new CategoriaDao($this->connection))->select("id_restaurante = " . Session::getSession('active_user')->getId());
        $this->setCategoria($cat);
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
     * Get the value of categoria
     */ 
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     *
     * @return  self
     */ 
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }
}