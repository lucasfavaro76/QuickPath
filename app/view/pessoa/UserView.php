<?php
namespace app\view\pessoa;

use app\model\PessoaModel;
use core\mvc\view\HtmlPage;


final class UserView extends HtmlPage{

    public function __construct(PessoaModel $model = null)
    {
        $this->htmlFile = 'app/view/pessoa/user_view.phtml';
        //$this->model = is_null($model) ? new PessoaModel() : $model;
    }

}