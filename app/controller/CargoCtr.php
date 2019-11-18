<?php


namespace app\controller;

use core\mvc\Controller;
use app\view\pessoa\NewUserView;
use app\view\pessoa\UserView;
use app\dao\PessoaDao;
use app\model\PessoaFisicaModel;
use app\model\PessoaJuridicaModel;
use app\model\PessoaModel;
use core\Application;
use core\mvc\view\Message;
use core\util\Session;
use app\view\Home;
use app\model\EnderecoModel;
use app\dao\PessoaFisicaDao;
use app\dao\PessoaJuridicaDao;
use app\view\dashboard\DashboardView;
use core\dao\Connection;
use app\model\FuncionarioModel;
use app\model\CargoModel;
use app\view\pessoa\NewFuncionarioView;
use app\dao\CargoDao;
use app\dao\FuncionarioDao;
use app\view\cargo\NewCargoView;

class CargoCtr extends Controller
{

    private $cargoView;
    private $session;

    public function __construct()
    {
        parent::__construct();
        $this->cargoView = new NewCargoView();
        $this->session = session_start();
        $this->connection = Connection::getConnection();
        //..verify if show a view do perform a new user or update a user
        $this->action = isset($this->get['action']) ? $this->get['action'] : 'update';
    }

    public function showView()
    {
        if ($this->action == 'new') {
            $this->cargoView->show();
        } else
            parent::showView();
    }

    public function getModelFromView()
    {
        if (!empty($this->post)) {

                return new CargoModel(
                    $this->post['id'],
                    $this->post['nome_cargo'],
                    Session::getSession('active_user')->getId()                    
                );            
        }
    }


    public function insertUpdate()
    {
        if ($this->get['action'] == 'new') {
            try {

                $model = $this->getModelFromView();

               
                    $cargo = new CargoDao($this->connection);
                    $cargo->insert($model);               
                
                    $dash = new DashboardView;
                    $dash->setMsg("Cargo cadastrado com sucesso!!!");
                    $dash->show();

            } catch (\Exception $ex) {                
                $dash = new DashboardView;
                $dash->setMsg("Problemas ao cadastrar cargo". $ex);
                $dash->show();
            }
        } else {
            parent::insertUpdate();
        }
    }

    public function uploadImage()
    {

        if (isset($_FILES['file']['name']) && $_FILES['file']['error'] == 0) {

            $nome_arquivo = $this->get['nome'];
            $nome = $this->files['file']['name'];
            // Pega a extensão
            $extensao = pathinfo($nome, PATHINFO_EXTENSION);

            // Converte a extensão para minúsculo
            $extensao = strtolower($extensao);

            // Somente imagens, .jpg;.jpeg;.gif;.png
            // Aqui eu enfileiro as extensões permitidas e separo por ';'
            // Isso serve apenas para eu poder pesquisar dentro desta String
            if (strstr('.jpg;.jpeg;.gif;.png', $extensao)) {
                // Cria um nome único para esta imagem
                // Evita que duplique as imagens no servidor.
                // Evita nomes com acentos, espaços e caracteres não alfanuméricos

                $destino = '/wamp64/www/QuickPath/app/img/';
                $uploadfile = $destino . $nome_arquivo . "." . $extensao;
                $tpm_file =  $this->files['file']['tmp_name'];

                // tenta mover o arquivo para o destino
                if (@move_uploaded_file($tpm_file, $uploadfile)) {
                    $result = array("result" => 1, "mensagem" => 'Arquivo salvo com sucesso em : ' . $destino . '');
                    echo json_encode($result);
                } else {
                    $result = array("result" => 0, "mensagem" => 'Erro ao salvar o arquivo.');
                    echo json_encode($result);
                }
            } else {
                $result = array("result" => 0, "mensagem" => 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"');
                echo json_encode($result);
            }
        } else {
            $result = array("result" => 0, "mensagem" => 'Você não enviou nenhum arquivo!');
            echo json_encode($result);
        }
    }

    public function doLogin()
    {
        if (!empty($this->get) && $this->get['method'] == 'doLogin') {
            try {
                $login_pessoa = $this->post['login_pessoa'];
                $senha_pessoa = $this->post['senha_pessoa'];
                $Pessoa = (new PessoaDao($this->connection))->doLogin($login_pessoa, $senha_pessoa);
                if ($Pessoa) {
                    if ($Pessoa->getTipo_pessoa() == "Juridica") {
                        Session::createSession('active_user', $Pessoa);
                        (new DashboardView())->show();
                    } else {
                        Session::createSession('active_user', $Pessoa);
                        Application::start();
                    }
                } else (new Message(
                    Application::$MSG_TITLE,
                    Application::$MSG_INCORRECT_LOGIN,
                    Application::$ICON_ERROR
                ))->show();
            } catch (\Exception $ex) { }
        } else {
            Application::start();
        }
    }

    public function doLogout()
    {
        if (!empty($this->get) && $this->get['method'] == 'doLogout') {
            Session::destroySession('active_user');
            Application::start();
        }
    }
}
