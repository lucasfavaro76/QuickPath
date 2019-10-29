<?php

namespace app\model;

use core\mvc\Model;

class PessoaFisicaModel extends PessoaModel
{
    protected $cpf_fisica;
    protected $tipo_pessoa;
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
        $cpf_fisica = null,
        $login_pessoa = null,
        $senha_pessoa = null,
        $status,
        $tipo_pessoa = null,
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

        $this->cpf_fisica = $cpf_fisica;
        $this->tipo_pessoa =  $tipo_pessoa;
        $this->id_pessoa = $id_pessoa;
    }



    /**
     * Get the value of cpf_fisica
     */
    public function getCpf_fisica()
    {
        return $this->cpf_fisica;
    }

    /**
     * Set the value of cpf_fisica
     *
     * @return  self
     */
    public function setCpf_fisica($cpf_fisica)
    {
        $this->cpf_fisica = $cpf_fisica;

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
     * Get the value of tipo_pessoa
     */
    public function getTipo_pessoa()
    {
        return $this->tipo_pessoa;
    }

    /**
     * Set the value of tipo_pessoa
     *
     * @return  self
     */
    public function setTipo_pessoa($tipo_pessoa)
    {
        $this->tipo_pessoa = $tipo_pessoa;

        return $this;
    }
}

// id_fisica integer not null default nextval('sid_fisica'),
// cpf_fisica varchar(15) not null UNIQUE,
// id_pessoa integer,
