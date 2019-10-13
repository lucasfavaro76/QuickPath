<?php
namespace app\view\pessoa;

use app\model\PessoaModel;
use core\mvc\view\HtmlPage;


final class NewUserView extends HtmlPage{

    public function __construct()
    {
        //$this->model = new PessoaModel();
        $this->htmlFile = 'app/view/pessoa/new_user_view.phtml';
    }

}