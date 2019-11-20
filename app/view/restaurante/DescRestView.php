<?php

namespace app\view\restaurante;

use app\dao\MesaDao;
use app\dao\NumMesaDao;
use app\dao\PessoaJuridicaDao;
use app\dao\ProdutoDao;
use core\mvc\view\HtmlPage;

use core\dao\Connection;


final class DescRestView extends HtmlPage
{

    protected $desc;
    protected $produtos;
    protected $mesas;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
        $this->htmlFile = 'app/view/restaurante/desc_rest.phtml';
    }


    public function showRest($id)
    {
        $jur = (new PessoaJuridicaDao($this->connection))->findById($id);
        $this->setDesc($jur);
    }
    public function showProd($id)
    {
       $prod = (new ProdutoDao($this->connection))->select("p.id_restaurante = " . $id );
       $this->setProdutos($prod);
    }

    public function showMesas($id)
    {
       $mesa = (new NumMesaDao($this->connection))->select(" id_restaurante = " . $id );
       $this->setMesas($mesa);
    }


    /**
     * Get the value of desc
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * Set the value of desc
     *
     * @return  self
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;

        return $this;
    }

    /**
     * Get the value of produtos
     */ 
    public function getProdutos()
    {
        return $this->produtos;
    }

    /**
     * Set the value of produtos
     *
     * @return  self
     */ 
    public function setProdutos($produtos)
    {
        $this->produtos = $produtos;

        return $this;
    }

    /**
     * Get the value of mesas
     */ 
    public function getMesas()
    {
        return $this->mesas;
    }

    /**
     * Set the value of mesas
     *
     * @return  self
     */ 
    public function setMesas($mesas)
    {
        $this->mesas = $mesas;

        return $this;
    }
}
