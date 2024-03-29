<?php
namespace app\view\categoria;

use core\mvc\view\HtmlPage;
use app\model\CategoriaModel;

final class CategoriaView extends HtmlPage{

    protected $msg;
    
    public function __construct(CategoriaModel $model = null)
    {
        $this->model = is_null($model) ? new CategoriaModel() : $model;
        $this->htmlFile = 'app/view/categoria/categoria_view.phtml';
    }

    public function renderHeader()
    {
        require_once('core\mvc\view\header_dashboard.phtml');
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
}