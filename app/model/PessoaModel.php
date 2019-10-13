<?php
namespace app\model;

use core\mvc\Model;

class PessoaModel extends Model
{
    protected $nome_pessoa;
    protected $telefone_pessoa;
    protected $celular_pessoa;
    protected $email_pessoa;
    protected $login_pessoa;
    protected $senha_pessoa;
    protected $id_endereco;
    protected $tipo_pessoa;



    public function __construct($id = null, $nome_pessoa = null, $telefone_pessoa= null, $celular_pessoa = null, $email_pessoa = null, $login_pessoa = null, $senha_pessoa = null, $id_endereco = null, $tipo_pessoa = null)
    {   
        parent::__construct($id);
        $this->nome_pessoa = $nome_pessoa;
        $this->telefone_pessoa = $telefone_pessoa;
        $this->celular_pessoa = $celular_pessoa;
        $this->email_pessoa = $email_pessoa;
        $this->login_pessoa = $login_pessoa;
        $this->senha_pessoa = $senha_pessoa;
        $this->id_endereco = $id_endereco;
        $this->tipo_pessoa = $tipo_pessoa;
    }


    
// id_pessoa integer not null default nextval('sid_pessoa'),
// nome_pessoa varchar (70) not null,
// telefone_pessoa varchar(15),
// celular_pessoa varchar(15),
// email_pessoa varchar(50),
// login_pessoa varchar(16) not null,
// senha_pessoa varchar(16) not null,
// id_endereco integer,
    

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
     * Get the value of id_endereco
     */ 
    public function getId_endereco()
    {
        return $this->id_endereco;
    }

    /**
     * Set the value of id_endereco
     *
     * @return  self
     */ 
    public function setId_endereco($id_endereco)
    {
        $this->id_endereco = $id_endereco;

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
