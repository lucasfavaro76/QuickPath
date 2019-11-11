<?php

namespace app\view;

use app\dao\PessoaJuridicaDao;
use core\Application;
use core\dao\Connection;
use core\mvc\view\HtmlPage;
use core\mvc\view\Message;
use app\controller\PessoaCtr;

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
            foreach ($result as $row) {
               
                $nome = strtolower(str_replace(" ", "_", $row->getRazao_social()));
                $jpg = 'C:/wamp64/www/QuickPath/app/img/' . $nome . '.jpg';
                $png =  'C:/wamp64/www/QuickPath/app/img/' . $nome . '.png';

                if (file_exists($jpg)) {
                    $tipo = ".jpg";
                    $desc = "Imagem do restaurante " . $row->getRazao_social();
                } else if (file_exists($png)) {
                    $tipo = ".png";
                    $desc = "Imagem do restaurante " . $row->getRazao_social();
                } else {                    
                    $tipo = "";
                    $desc = "Desculpe mas essa imagem nao esta disponivel!!";
                }

                echo "<div style='margin-left:3vw;' class='p-5 md-col-4'>
                 <div class='card'>
                <img class='card-img-top' src='app/img/" . $nome . $tipo . "' alt='" . $desc . "'>
                 <div class='card-body'>
                    <h5 class='card-title'>" . $row->getRazao_social() . "</h5>
                 <p class='card-text'>" . $row->getDescricao() . "</p>
                 <a href='#' class='btn btn-primary'>Go somewhere</a>
                 </div>
                </div>
                </div>";
            }            
        }
    }
}
