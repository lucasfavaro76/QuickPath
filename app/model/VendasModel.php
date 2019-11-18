<?php

namespace app\model;

use core\mvc\Model;

class VendasModel extends Model
{
    protected $preco_total;
    protected $data_venda;
    protected $hora_venda;
    protected $tipo_pagamento;
    protected $id_funcionario;
    protected $id_restaurante;
    protected $id_pessoa;
    protected $id_produto;

    public function __construct($id,$preco_total, $data_venda, $hora_venda, $tipo_pagamento, $id_funcionario, $id_restaurante, $id_pessoa, $id_produto)
    {
        parent::__construct($id);
        $this->preco_total = $preco_total;
        $this->data_venda = $data_venda;
        $this->hora_venda = $hora_venda;
        $this->tipo_pagamento = $tipo_pagamento;
        $this->id_funcionario = $id_funcionario;
        $this->id_restaurante = $id_restaurante;
        $this->id_pessoa = $id_pessoa;
        $this->id_produto = $id_produto;
    }

    


    /**
     * Get the value of preco_total
     */ 
    public function getPreco_total()
    {
        return $this->preco_total;
    }

    /**
     * Set the value of preco_total
     *
     * @return  self
     */ 
    public function setPreco_total($preco_total)
    {
        $this->preco_total = $preco_total;

        return $this;
    }

    /**
     * Get the value of data_venda
     */ 
    public function getData_venda()
    {
        return $this->data_venda;
    }

    /**
     * Set the value of data_venda
     *
     * @return  self
     */ 
    public function setData_venda($data_venda)
    {
        $this->data_venda = $data_venda;

        return $this;
    }

    /**
     * Get the value of hora_venda
     */ 
    public function getHora_venda()
    {
        return $this->hora_venda;
    }

    /**
     * Set the value of hora_venda
     *
     * @return  self
     */ 
    public function setHora_venda($hora_venda)
    {
        $this->hora_venda = $hora_venda;

        return $this;
    }

    /**
     * Get the value of tipo_pagamento
     */ 
    public function getTipo_pagamento()
    {
        return $this->tipo_pagamento;
    }

    /**
     * Set the value of tipo_pagamento
     *
     * @return  self
     */ 
    public function setTipo_pagamento($tipo_pagamento)
    {
        $this->tipo_pagamento = $tipo_pagamento;

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
     * Get the value of id_produto
     */ 
    public function getId_produto()
    {
        return $this->id_produto;
    }

    /**
     * Set the value of id_produto
     *
     * @return  self
     */ 
    public function setId_produto($id_produto)
    {
        $this->id_produto = $id_produto;

        return $this;
    }
    }
