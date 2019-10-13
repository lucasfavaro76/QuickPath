<?php

namespace app\model;

use core\mvc\Model;

class PessoaJuridicaModel extends PessoaModel
{  
    protected $cnpj_juridica;
    protected $razao_social;
    protected $tipo_pessoa;
    protected $id_pessoa;

    public function __construct($id= null, $nome_pessoa = null, $telefone_pessoa = null, $celular_pessoa = null, $email_pessoa = null, $cnpj_juridica = null, $razao_social = null, $login_pessoa = null, $senha_pessoa = null, $id_endereco = null, $tipo_pessoa = null,$id_pessoa = null)
    {
        parent::__construct($id,$nome_pessoa, $telefone_pessoa, $celular_pessoa, $email_pessoa, $login_pessoa, $senha_pessoa, $id_endereco);
        
        $this->cnpj_juridica = $cnpj_juridica;
        $this->razao_social = $razao_social;
        $this->tipo_pessoa = $tipo_pessoa;
        $this->id_pessoa = $id_pessoa;
    }


    /**
     * Get the value of cnpj_juridica
     */ 
    public function getCnpj_juridica()
    {
        return $this->cnpj_juridica;
    }

    /**
     * Set the value of cnpj_juridica
     *
     * @return  self
     */ 
    public function setCnpj_juridica($cnpj_juridica)
    {
        $this->cnpj_juridica = $cnpj_juridica;

        return $this;
    }

    /**
     * Get the value of razao_social
     */ 
    public function getRazao_social()
    {
        return $this->razao_social;
    }

    /**
     * Set the value of razao_social
     *
     * @return  self
     */ 
    public function setRazao_social($razao_social)
    {
        $this->razao_social = $razao_social;

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

    
}

// id_juridica integer not null default nextval('sid_juridica'),
// cnpj_juridica varchar(18) not null UNIQUE,
// razao_social varchar(70) not null UNIQUE,
// id_pessoa integer,
