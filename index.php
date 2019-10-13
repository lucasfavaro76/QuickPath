<?php
require_once('autoload.php');

use core\Application;
use app\model\PessoaModel;
use app\dao\PessoaDao;

// use app\model\FlowModel;
// use app\dao\FlowDao;
// use app\model\CategoryModel;

Application::start();


// try {
//     $userModel = new UserModel(null, 'Jorge', 'M', 'jlgregorio81@gmail.com', '123', 'I', 'U', null);
//     (new UserDao())->insert($userModel);
// } catch (\Exception $ex) {
//     echo "Erro: {$ex->getMessage()}";
// }
