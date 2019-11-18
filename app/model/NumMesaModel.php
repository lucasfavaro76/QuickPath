<?php

namespace app\model;

use core\mvc\Model;

class NumMesaModel extends Model
{
    protected $num_mesa;
    protected $id_restaurante;    

    public function __construct(
        $id = null,
        $num_mesa = null,
        $id_restaurante = null
    ) {
        parent::__construct($id);
        $this->num_mesa = $num_mesa;
        $this->id_restaurante = $id_restaurante;
    }


    /**
     * Get the value of num_mesa
     */
    public function getNum_mesa()
    {
        return $this->num_mesa;
    }

    /**
     * Set the value of num_mesa
     *
     * @return  self
     */
    public function setNum_mesa($num_mesa)
    {
        $this->num_mesa = $num_mesa;

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
