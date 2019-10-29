<?php

namespace app\view;

use app\dao\PessoaJuridicaDao;
use core\Application;
use core\dao\Connection;
use core\mvc\view\HtmlPage;
use core\mvc\view\Message;

final class Home extends HtmlPage
{
    public function __construct()
    {
        $this->htmlFile = 'app/view/home.phtml';
        $this->connection = Connection::getConnection();
    }

    public function showAll()
    {
        $rest = new PessoaJuridicaDao($this->connection);
        $result = $rest->selectAll();
        if (empty($result)) {
            (new Message(null, Application::$MSG_VAZIO, Application::$ICON_ERROR))->show();
        } else {
            echo "<div class='row'> ";
            foreach ($result as $row) {
                echo "<div class='p-5 md-col-4'>
                 <div class='card' style='width: 18rem;'>
                <img class='card-img-top' src='...' alt='Card image cap'>
                 <div class='card-body'>
                    <h5 class='card-title'>" . $row->getRazao_social() . "</h5>
                 <p class='card-text'>" . $row->getDescricao() . "</p>
                 <a href='#' class='btn btn-primary'>Go somewhere</a>
                 </div>
                </div>
                </div>";
            }
            echo "</dvi>";
        }
    }
}
