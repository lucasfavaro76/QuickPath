<?php

namespace app\model;



class FuncionarioModel extends PessoaModel
{
    protected $cargo;
    protected $id_pessoa;
    protected $salario;
    protected $id_juridica;
    protected $cpf_funcionario;

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
        CargoModel $cargo = null,
        $salario = null,
        $id_juridica = null,
        $cpf_funcionario = null,
        $login_pessoa = null,
        $senha_pessoa = null,
        $status =  null,
        $tipo_pessoa = null
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
            $status,
            $tipo_pessoa
        );
        $this->salario = $salario;
        $this->cargo = is_null($cargo) ? new CargoModel() : $cargo;
        $this->id_juridica = $id_juridica;
        $this->cpf_funcionario = $cpf_funcionario;

    }

    /**
     * Get the value of cargo
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set the value of cargo
     *
     * @return  self
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

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

    /**
     * Get the value of salario
     */
    public function getSalario()
    {
        return $this->salario;
    }

    /**
     * Set the value of salario
     *
     * @return  self
     */
    public function setSalario($salario)
    {
        $this->salario = $salario;

        return $this;
    }

    /**
     * Get the value of cpf_funcionario
     */ 
    public function getCpf_funcionario()
    {
        return $this->cpf_funcionario;
    }

    /**
     * Set the value of cpf_funcionario
     *
     * @return  self
     */ 
    public function setCpf_funcionario($cpf_funcionario)
    {
        $this->cpf_funcionario = $cpf_funcionario;

        return $this;
    }
}

// id_fisica integer not null default nextval('sid_fisica'),
// cpf_fisica varchar(15) not null UNIQUE,
// id_pessoa integer,
