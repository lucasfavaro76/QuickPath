<?php
namespace app\view\pessoa;

use app\model\PessoaModel;
use core\mvc\view\HtmlPage;


final class UserView extends HtmlPage{

    protected $msg;
    protected $dados;

    public function __construct(PessoaModel $model = null)
    {
        $this->htmlFile = 'app/view/pessoa/user_view.phtml';
        $this->model = is_null($model) ? new PessoaModel() : $model;
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