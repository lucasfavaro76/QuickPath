<?php

namespace app\view\cargo;

use app\dao\VendasDao;
use core\dao\Connection;
use core\mvc\view\HtmlPage;


final class NewCargoView extends HtmlPage
{

    protected $vendas;
    protected $msg;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
        $this->htmlFile = 'app/view/cargo/new_cargo_view.phtml';
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
}
