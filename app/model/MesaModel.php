<?php
namespace app\model;

use core\mvc\Model;

class MesaModel extends Model{

    protected $numero_mesa;   
    protected $id_funcionario;
    protected $id_pessoa;
    protected $id_restaurante;

    public function __construct($id = null, NumMesaModel $numero_mesa = null, $id_funcionario, PessoaModel $id_pessoa = null, $id_restaurante)
    {
        parent::__construct($id);
        $this->numero_mesa = is_null($numero_mesa) ? new NumMesaModel() : $numero_mesa;    
        $this->id_funcionario = $id_funcionario;
        $this->id_pessoa = is_null($id_pessoa) ? new PessoaModel() : $id_pessoa;
        $this->id_restaurante = $id_restaurante;
    }



    /**
     * Get the value of numero_mesa
     */ 
    public function getNumero_mesa()
    {
        return $this->numero_mesa;
    }

    /**
     * Set the value of numero_mesa
     *
     * @return  self
     */ 
    public function setNumero_mesa($numero_mesa)
    {
        $this->numero_mesa = $numero_mesa;

        return $this;
    }

    /**
     * Get the value of id_funcionario
     */ 
    public function getId_funcionario()
    {
        return $this->id_funcionario;
    }

    /**
     * Set the value of id_funcionario
     *
     * @return  self
     */ 
    public function setId_funcionario($id_funcionario)
    {
        $this->id_funcionario = $id_funcionario;

        return $this;
    }

    /**
     * Get the value of id_pessoa
     */ 
    public function getId_pessoa()
    {
        return $this->id_pessoa;
    }

    /**
     * Set the value of id_pessoa
     *
     * @return  self
     */ 
    public function setId_pessoa($id_pessoa)
    {
        $this->id_pessoa = $id_pessoa;

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