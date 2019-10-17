<?php
namespace app\controller;

use core\mvc\Controller;
use app\view\pessoa\NewUserView;
use app\view\pessoa\UserView;
use app\dao\PessoaDao;

use core\Application;
use core\mvc\view\Message;
use core\util\Session;
use app\view\Home;
use app\model\EnderecoModel;
use app\dao\EnderecoDao;

class EnderecoCtr extends Controller
{
    private $newUserView;
    private $action; //..determine if show NewUserView or UserView

    public function __construct()
    {
        parent::__construct();        
        $this->dao = new EnderecoDao();
        $this->list = null; //..view to query the users
        //..verify if show a view do perform a new user or update a user
        $this->action = isset($this->get['action']) ? $this->get['action'] : 'update';
    }

    public function showView()
    {
        if ($this->action == 'new')
            $this->newUserView->show();
        else
            parent::showView();
    }

    public function getModelFromView($id)
    {
        if (!empty($this->post)) {                    
                return new EnderecoModel(                   
                    $this->post['cep'],
                    $this->post['logradouro'],
                    $this->post['numero'],
                    $this->post['complemento'],
                    $this->post['bairro'], 
                    $this->post['cidade'],
                    $this->post['uf']                                                 
                );            
        }
    }

    public function insertUpdate()
    {
        if ($this->get['action'] == 'new') {
            try {
                $id = null;
                $model = $this->getModelFromView($id);

                $id = (new EnderecoDao())->insert($model);       
                return $id;
                //(new Message('Mensagem', 'Cadastro efetuado com sucesso! Verifique seu e-mail!', Application::$ICON_SUCCESS))->show();
            } catch (\Exception $ex) {
                (new Message(null, Application::$MSG_ERROR, Application::$ICON_ERROR))->show();
            }
        } else {
            parent::insertUpdate();
        }
    }


}
