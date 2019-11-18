<?php

namespace app\model;

use core\mvc\Model;

class PessoaJuridicaModel extends PessoaModel
{
    protected $cnpj_juridica;
    protected $razao_social;
    protected $descricao;
    protected $tipo_pessoa;
    protected $imagem;

    protected $id_pessoa;

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
        $id_pessoa = null
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

        $this->cnpj_juridica = $cnpj_juridica;
        $this->razao_social = $razao_social;
        $this->descricao = $descricao;
        $this->tipo_pessoa = $tipo_pessoa;
        $this->imagem = $imagem;
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
}

// id_juridica integer not null default nextval('sid_juridica'),
// cnpj_juridica varchar(18) not null UNIQUE,
// razao_social varchar(70) not null UNIQUE,
// id_pessoa integer,
