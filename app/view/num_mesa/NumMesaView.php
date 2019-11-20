<?php

namespace app\view\num_mesa;

use app\dao\VendasDao;
use core\dao\Connection;
use core\mvc\view\HtmlPage;


final class NumMesaView extends HtmlPage
{

   
    protected $msg;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
        $this->htmlFile = 'app/view/num_mesa/new_num_mesa.phtml';
    }

    public function renderHeader()
    {
        require_once('core\mvc\view\header_dashboard.phtml');
    }

    public function renderFooter()
    {
        require_once('core\mvc\view\footer.phtml');
    }

    public function show()
    {
        $this->renderHeader();
        require_once($this->htmlFile);
        $this->renderFooter();
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
