<?php

namespace app\view\restaurante;

use app\dao\PessoaJuridicaDao;
use core\mvc\view\HtmlPage;

use core\dao\Connection;


final class DescRestView extends HtmlPage
{

    protected $desc;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
        $this->htmlFile = 'app/view/restaurante/desc_rest.phtml';
    }


    public function showRest($id)
    {
        $jur = (new PessoaJuridicaDao($this->connection))->findById($id);
        $this->setDesc($jur);
    }



    /**
     * Get the value of desc
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * Set the value of desc
     *
     * @return  self
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;

        return $this;
    }
}
