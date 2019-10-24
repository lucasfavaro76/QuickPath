<?php
require_once('autoload.php');

use core\Application;
use app\model\PessoaModel;
use app\dao\PessoaDao;
use app\model\PessoaFisicaModel;
use core\dao\Connection;
use app\dao\PessoaFisicaDao;

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


// $pessoaFisica = new PessoaFisicaModel(null,'Jorge','111','222','jljl@jl.com','111','rua x','234','casa','centro','Jales','SP','112233','eu','123456','Física',null);

// $conn = Connection::getConnection();

// $pfDao = new PessoaFisicaDao($conn);

// $pfDao->insert($pessoaFisica);