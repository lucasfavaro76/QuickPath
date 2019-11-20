<?php

namespace app\view\produto;

use app\dao\CategoriaDao;
use core\mvc\view\HtmlPage;

use core\dao\Connection;
use core\util\Session;

final class NewProdutoView extends HtmlPage
{

    protected $msg;
    protected $categoria;
    protected $Juridica;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
        $this->htmlFile = 'app/view/produto/new_produto_view.phtml';
        $this->showProd();
    }

    public function renderHeader()
    {
        require_once('core\mvc\view\header_dashboard.phtml');
    }

    public function show()
    {
        $this->renderHeader();
        require_once($this->htmlFile);
        $this->renderFooter();
    }

    public function showProd()
    {
        $prod = new CategoriaDao();
        $result = $prod->select('id_restaurante = ' . Session::getSession('active_user')->getId());
        $this->setCategoria($result);
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
