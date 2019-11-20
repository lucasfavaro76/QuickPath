<?php
namespace app\model;

use core\mvc\Model;

final class CategoriaModel extends Model {

    private $nome_categoria;
    private $id_restaurante;

    public function __construct($id = null, $nome_categoria = null, $id_restaurante = null)
    {
        parent::__construct($id);
        $this->nome_categoria = $nome_categoria;
        $this->id_restaurante = $id_restaurante;
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

    /**
     * Get the value of id_restaurante
     */ 
    public function getId_restaurante()
    {
        return $this->id_restaurante;
    }

    /**
     * Set the value of id_restaurante
     *
     * @return  self
     */ 
    public function setId_restaurante($id_restaurante)
    {
        $this->id_restaurante = $id_restaurante;

        return $this;
    }
}