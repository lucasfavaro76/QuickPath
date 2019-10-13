<?php
namespace app\model;

use core\mvc\Model;

final class CategoriaModel extends Model {

    private $nome_categoria;

    public function __construct($id=null, $nome_categoria=null)
    {
        parent::__construct($id);
        $this->nome_categoria = $nome_categoria;
    }

    


    /**
     * Get the value of nome_categoria
     */ 
    public function getNome_categoria()
    {
        return $this->nome_categoria;
    }

    /**
     * Set the value of nome_categoria
     *
     * @return  self
     */ 
    public function setNome_categoria($nome_categoria)
    {
        $this->nome_categoria = $nome_categoria;

        return $this;
    }
}