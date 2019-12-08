<?php
namespace app\view\pessoa;

use app\model\PessoaFisicaModel;
use app\model\PessoaModel;
use core\dao\Connection;
use core\mvc\view\HtmlPage;


final class UpDadosPessoa extends HtmlPage{

    protected $msg;
    protected $dados;
    protected $connection;

    public function __construct(PessoaFisicaModel $model = null)
    {
        $id = null;
        $this->connection = Connection::getConnection();
        $this->htmlFile = 'app/view/pessoa/up_dados_pessoa.phtml';
       // $this->model = is_null($model) ? new PessoaFisicaModel() : $model;
    }


    /**
     * Get the value of msg
     */ 
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * Set the value of msg
     *
     * @return  self
     */ 
    public function setMsg($msg)
    {
        $this->msg = $msg;

        return $this;
    }

    /**
     * Get the value of dados
     */ 
    public function getDados()
    {
        return $this->dados;
    }

    /**
     * Set the value of dados
     *
     * @return  self
     */ 
    public function setDados($dados)
    {
        $this->dados = $dados;

        return $this;
    }
}