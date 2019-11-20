<?php

namespace app\model;

use core\mvc\Model;

class PessoaJuridicaModel extends PessoaModel
{
    protected $id_juridica;
    protected $cnpj_juridica;
    protected $razao_social;
    protected $descricao;
    protected $tipo_pessoa;
    protected $imagem;
    

    public function __construct(
        $id = null,
        $nome_pessoa = null,
        $telefone_pessoa = null,
        $celular_pessoa = null,
        $email_pessoa = null,
        $cep = null,
        $logradouro = null,
        $numero = null,
        $complemento = null,
        $bairro = null,
        $cidade = null,
        $uf = null,
        $cnpj_juridica = null,
        $razao_social = null,
        $descricao = null,
        $login_pessoa = null,
        $senha_pessoa = null,
        $status = null,
        $tipo_pessoa = null,
        $imagem = null,
        $id_juridica = null
    ) {
        parent::__construct(
            $id,
            $nome_pessoa,
            $telefone_pessoa,
            $celular_pessoa,
            $email_pessoa,
            $cep,
            $logradouro,
            $numero,
            $complemento,
            $bairro,
            $cidade,
            $uf,            
            $login_pessoa,
            $senha_pessoa,
            $status
        );

        $this->id_juridica = $id_juridica;
        $this->cnpj_juridica = $cnpj_juridica;
        $this->razao_social = $razao_social;
        $this->descricao = $descricao;
        $this->tipo_pessoa = $tipo_pessoa;
        $this->imagem = $imagem;
       
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
     * Get the value of descricao
     */ 
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */ 
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of imagem
     */ 
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * Set the value of imagem
     *
     * @return  self
     */ 
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;

        return $this;
    }

    /**
     * Get the value of id_juridica
     */ 
    public function getId_juridica()
    {
        return $this->id_juridica;
    }

    /**
     * Set the value of id_juridica
     *
     * @return  self
     */ 
    public function setId_juridica($id_juridica)
    {
        $this->id_juridica = $id_juridica;

        return $this;
    }
}

// id_juridica integer not null default nextval('sid_juridica'),
// cnpj_juridica varchar(18) not null UNIQUE,
// razao_social varchar(70) not null UNIQUE,
// id_pessoa integer,
