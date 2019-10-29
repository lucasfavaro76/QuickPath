<?php

namespace app\model;

use core\mvc\Model;

class PessoaModel extends Model
{
    protected $nome_pessoa;
    protected $telefone_pessoa;
    protected $celular_pessoa;
    protected $email_pessoa;
    protected $cep;
    protected $logradouro;
    protected $numero;
    protected $complemento;
    protected $bairro;
    protected $cidade;
    protected $uf;
    protected $login_pessoa;
    protected $senha_pessoa;
    protected $status;
    protected $tipo_pessoa;

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
        $login_pessoa = null,
        $senha_pessoa = null,
        $status = null,
        $tipo_pessoa = null
    ) {
        parent::__construct($id);
        $this->nome_pessoa = $nome_pessoa;
        $this->telefone_pessoa = $telefone_pessoa;
        $this->celular_pessoa = $celular_pessoa;
        $this->email_pessoa = $email_pessoa;
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->complemento = $complemento;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->uf = $uf;
        $this->login_pessoa = $login_pessoa;
        $this->senha_pessoa = $senha_pessoa;
        $this->tipo_pessoa = $tipo_pessoa;
        $this->status = $status;
    }



    // nome_pessoa varchar (70) not null,
    // telefone_pessoa varchar(15),
    // celular_pessoa varchar(15),
    // email_pessoa varchar(50),
    // cep varchar(9),
    // logradouro varchar(50),
    // numero integer,
    // complemento varchar(70),
    // bairro varchar(50),
    // cidade varchar(50),
    // login_pessoa varchar(16) not null,
    // senha_pessoa text not null,



    /**
     * Get the value of nome_pessoa
     */
    public function getNome_pessoa()
    {
        return $this->nome_pessoa;
    }

    /**
     * Set the value of nome_pessoa
     *
     * @return  self
     */
    public function setNome_pessoa($nome_pessoa)
    {
        $this->nome_pessoa = $nome_pessoa;

        return $this;
    }

    /**
     * Get the value of telefone_pessoa
     */
    public function getTelefone_pessoa()
    {
        return $this->telefone_pessoa;
    }

    /**
     * Set the value of telefone_pessoa
     *
     * @return  self
     */
    public function setTelefone_pessoa($telefone_pessoa)
    {
        $this->telefone_pessoa = $telefone_pessoa;

        return $this;
    }

    /**
     * Get the value of celular_pessoa
     */
    public function getCelular_pessoa()
    {
        return $this->celular_pessoa;
    }

    /**
     * Set the value of celular_pessoa
     *
     * @return  self
     */
    public function setCelular_pessoa($celular_pessoa)
    {
        $this->celular_pessoa = $celular_pessoa;

        return $this;
    }

    /**
     * Get the value of email_pessoa
     */
    public function getEmail_pessoa()
    {
        return $this->email_pessoa;
    }

    /**
     * Set the value of email_pessoa
     *
     * @return  self
     */
    public function setEmail_pessoa($email_pessoa)
    {
        $this->email_pessoa = $email_pessoa;

        return $this;
    }

    /**
     * Get the value of login_pessoa
     */
    public function getLogin_pessoa()
    {
        return $this->login_pessoa;
    }

    /**
     * Set the value of login_pessoa
     *
     * @return  self
     */
    public function setLogin_pessoa($login_pessoa)
    {
        $this->login_pessoa = $login_pessoa;

        return $this;
    }

    /**
     * Get the value of senha_pessoa
     */
    public function getSenha_pessoa()
    {
        return $this->senha_pessoa;
    }

    /**
     * Set the value of senha_pessoa
     *
     * @return  self
     */
    public function setSenha_pessoa($senha_pessoa)
    {
        $this->senha_pessoa = $senha_pessoa;

        return $this;
    }


    /**
     * Get the value of tipo_pessoa
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of tipo_pessoa
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of cep
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set the value of cep
     *
     * @return  self
     */
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get the value of logradouro
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * Set the value of logradouro
     *
     * @return  self
     */
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;

        return $this;
    }

    /**
     * Get the value of numero
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of complemento
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * Set the value of complemento
     *
     * @return  self
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;

        return $this;
    }

    /**
     * Get the value of bairro
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set the value of bairro
     *
     * @return  self
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get the value of cidade
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set the value of cidade
     *
     * @return  self
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get the value of uf
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * Set the value of uf
     *
     * @return  self
     */
    public function setUf($uf)
    {
        $this->uf = $uf;

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
