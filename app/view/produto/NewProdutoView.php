<?php

namespace app\view\produto;


use core\mvc\view\HtmlPage;

use core\dao\Connection;


final class NewProdutoView extends HtmlPage
{

    protected $categoria;
    protected $Juridica;

    public function __construct()
    {    
        $this->connection = Connection::getConnection();
        $this->htmlFile = 'app/view/produto/new_produto_view.phtml';
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
