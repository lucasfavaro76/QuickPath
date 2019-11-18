<?php

namespace app\model;

use core\mvc\Model;

class ProdutoModel extends Model
{
    protected $nome_produto;
    protected $unidade_produto;
    protected $preco_produto;
    protected $categoria;
    protected $id_restaurante;
    protected $quant_estoque;

    public function __construct($id,$nome_produto, $unidade_produto, $preco_produto,CategoriaModel  $categoria = null , $id_restaurante, $quant_estoque)
    {
        parent::__construct($id);
        $this->nome_produto = $nome_produto;
        $this->unidade_produto = $unidade_produto;
        $this->preco_produto = $preco_produto;
        $this->categoria = is_null($categoria) ? new CategoriaModel() : $categoria;
        $this->id_restaurante = $id_restaurante;
        $this->quant_estoque = $quant_estoque;
    }

    

    /**
     * Get the value of nome_produto
     */ 
    public function getNome_produto()
    {
        return $this->nome_produto;
    }

    /**
     * Set the value of nome_produto
     *
     * @return  self
     */ 
    public function setNome_produto($nome_produto)
    {
        $this->nome_produto = $nome_produto;

        return $this;
    }

    /**
     * Get the value of unidade_produto
     */ 
    public function getUnidade_produto()
    {
        return $this->unidade_produto;
    }

    /**
     * Set the value of unidade_produto
     *
     * @return  self
     */ 
    public function setUnidade_produto($unidade_produto)
    {
        $this->unidade_produto = $unidade_produto;

        return $this;
    }

    /**
     * Get the value of preco_produto
     */ 
    public function getPreco_produto()
    {
        return $this->preco_produto;
    }

    /**
     * Set the value of preco_produto
     *
     * @return  self
     */ 
    public function setPreco_produto($preco_produto)
    {
        $this->preco_produto = $preco_produto;

        return $this;
    }

    /**
     * Get the value of id_categoria
     */ 
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set the value of id_categoria
     *
     * @return  self
     */ 
    public function setcategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get the value of id_restarante
     */ 
    public function getId_restaurante()
    {
        return $this->id_restaurante;
    }

    /**
     * Set the value of id_restarante
     *
     * @return  self
     */ 
    public function setId_restaurante($id_restaurante)
    {
        $this->id_restaurante = $id_restaurante;

        return $this;
    }

    /**
     * Get the value of quant_estoque
     */ 
    public function getQuant_estoque()
    {
        return $this->quant_estoque;
    }

    /**
     * Set the value of quant_estoque
     *
     * @return  self
     */ 
    public function setQuant_estoque($quant_estoque)
    {
        $this->quant_estoque = $quant_estoque;

        return $this;
    }
}