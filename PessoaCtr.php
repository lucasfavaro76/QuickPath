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

class PessoaCtr extends Controller
{

    private $newUserView;
    private $action; //..determine if show NewUserView or UserView
    private $session;

    public function __construct()
    {
        parent::__construct();
        $this->session = session_start();
        $this->view = new UserView();
        $this->newUserView = new NewUserView();
        $this->connection = Connection::getConnection();
        //$this->dao = new PessoaDao($connection);
        $this->list = null; //..view to query the users
        //..verify if show a view do perform a new user or update a user
        $this->action = isset($this->get['action']) ? $this->get['action'] : 'update';
    }

    public function showView()
    {
        if ($this->action == 'new') {
            $this->newUserView->show();
        } else
            parent::showView();
    }   

    public function getModelFromView()
    {
        if (!empty($this->post)) {

            if ($this->post['tipo'] == "Juridica") {
                return new PessoaJuridicaModel(
                    $this->post['id'],
                    $this->post['nome_pessoa'],
                    $this->post['telefone_pessoa'],
                    $this->post['celular_pessoa'],
                    $this->post['email_pessoa'],
                    $this->post['cep'],
                    $this->post['logradouro'],
                    $this->post['numero'],
                    $this->post['complemento'],
                    $this->post['bairro'],
                    $this->post['cidade'],
                    $this->post['uf'],
                    $this->post['cnpj_juridica'],
                    $this->post['razao_social'],
                    $this->post['descricao'],
                    $this->post['login_pessoa'],
                    $this->post['senha_pessoa'],
                    'I',
                    'Juridica',
                    $this->post['imagem'],
                    $this->post['id']

                );
            } else if ($this->post['tipo'] == "Fisica") {
                return new PessoaFisicaModel(
                    $this->post['id'],
                    $this->post['nome_pessoa'],
                    $this->post['telefone_pessoa'],
                    $this->post['celular_pessoa'],
                    $this->post['email_pessoa'],
                    $this->post['cep'],
                    $this->post['logradouro'],
                    $this->post['numero'],
                    $this->post['complemento'],
                    $this->post['bairro'],
                    $this->post['cidade'],
                    $this->post['uf'],
                    $this->post['cpf_fisica'],
                    $this->post['login_pessoa'],
                    $this->post['senha_pessoa'],
                    'I',
                    'Fisica'

                );
            } else {
                return new FuncionarioModel(
                    $this->post['id'],
                    $this->post['nome_pessoa'],
                    $this->post['telefone_pessoa'],
                    $this->post['celular_pessoa'],
                    $this->post['email_pessoa'],
                    $this->post['cep'],
                    $this->post['logradouro'],
                    $this->post['numero'],
                    $this->post['complemento'],
                    $this->post['bairro'],
                    $this->post['cidade'],
                    $this->post['uf'],
                    new CargoModel($this->post['cargo'], null),
                    $this->post['id_juridica'],
                    $this->post['login_pessoa'],
                    $this->post['senha_pessoa'],
                    'I',
                    'Funcionario'
                );
            }
        }
    }

    public function activateUser()
    {
        try {
            $email = $this->get['email'];
            (new PessoaDao($this->connection))->activateUser($email);
            (new Message(Application::$MSG_TITLE, Application::$MSG_ACTIVATE, Application::$ICON_SUCCESS))->show();
        } catch (\Exception $ex) {
            (new Message(Application::$MSG_TITLE, Application::$MSG_ERROR, Application::$MSG_ERROR))->show();
        }
    }

    public function insertUpdate()
    {
        if ($this->get['action'] == 'new') {
            try {

                $model = $this->getModelFromView();

                if ($model->getTipo_pessoa() == "Juridica") {
                    $Juridica = new PessoaJuridicaDao($this->connection);
                    $result = $Juridica->insert($model);
                } else if ($model->getTipo_pessoa() == "Fisica") {
                    $Fisica =  new PessoaFisicaDao($this->connection);
                    $result = $Fisica->insert($model);
                } else if ($model->getTipo_pessoa() == "Funcionario") {
                    $Funcionario = new FuncionarioDao($this->connection);
                    $result = $Funcionario->insert($model);
                }

                $link = Application::$HOST . "Request.php?class=PessoaCtr&method=activateUser&email={$model->getEmail_pessoa()}";
                if ($model->getTipo_pessoa() == "Juridica") {

                    $msg = "<div class='text-center'><h1>" . Application::$APP_NAME . "</h1><hr>";
                    $msg .= "<h2>Ativação de cadastro - não responda!</h2>";
                    $msg .= "<p>Seja bem vindo ao " . Application::$APP_NAME . " " . $model->getNome_pessoa() . ", seu cadastro foi realizado com sucesso!! Apartir do momento em que ativar seu cadastro voçê terá total acesso as configurações do seu restaurante e ele aparecera na pagina inicial do site</p>";
                    $msg .= "<p><a href=\"$link\">Clique Aqui para ativar seu restaurante</a></p></div>";
                    $msg .= "<p class='p-5'>Atenciosamente, Equipe " . Application::$APP_NAME . "</p>";
                } else {
                    $msg = "<h1>" . Application::$APP_NAME . "</h1><hr>";
                    $msg .= "<h2>Ativação de cadastro - não responda!</h2>";
                    $msg .= "<p>Seja Bem vindo ao " . Application::$APP_NAME . " " . $model->getNome_pessoa() . ", confirme seu E-mail para acessar o site, realizar a reserva de mesa e ganhar descontos especiais que voçê só encontra aqui!!</p>";
                    $msg .= "<p><a href=\"$link\">Clique Aqui para confirmar seu E-mail</a></p>";
                    $msg .= "<p class='p-5'>Atenciosamente, Equipe " . Application::$APP_NAME . "</p>";
                }

                Application::sendEmail($model->getEmail_pessoa(), 'Ativação de Cadastro', $msg);

                if ($model->getTipo_pessoa() == "Funcionario") {
                    $func = new NewFuncionarioView;
                    $func->setMsg("Cadastro efetuado com sucesso!!!");
                    $func->show();
                } else {
                    (new Message('Mensagem', 'Cadastro efetuado com sucesso! Verifique seu e-mail!', Application::$ICON_SUCCESS))->show();
                }
            } catch (\Exception $ex) {
                //$connection->rollBack();
                (new Message(null, Application::$MSG_ERROR, Application::$ICON_ERROR))->show();
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
                $imagem = $nome_arquivo . "." . $extensao;
                $destino = realpath('../QuickPath/app/img/');
                $uploadfile = $destino ."/". $imagem;
                $tpm_file =  $this->files['file']['tmp_name'];

                // tenta mover o arquivo para o destino
                if (@move_uploaded_file($tpm_file, $uploadfile)) {
                    $result = array("result" => 1, "mensagem" => 'Arquivo salvo com sucesso!!!', "caminho" => $imagem);
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
