<?php
namespace app\model;

use core\mvc\Model;

final class CargoModel extends Model {

    private $nome_cargo;
    private $id_restaurante;

    public function __construct($id=null, $nome_cargo=null, $id_restaurante = null)
    {
        parent::__construct($id);
        $this->nome_cargo = $nome_cargo;
        $this->id_restaurante = $id_restaurante;
    }

    
    /**
     * Get the value of nome_cargo
     */ 
    public function getNome_cargo()
    {
        return $this->nome_cargo;
    }

    /**
     * Set the value of nome_cargo
     *
     * @return  self
     */ 
    public function setNome_cargo($nome_cargo)
    {
        $this->nome_cargo = $nome_cargo;

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