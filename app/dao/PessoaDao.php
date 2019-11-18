<?php

namespace app\dao;

use app\model\PessoaFisicaModel;
use app\model\PessoaJuridicaModel;
use core\dao\IDao;
use app\model\PessoaModel;
use core\dao\Connection;

class PessoaDao implements IDao
{

    protected $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function insert(PessoaModel $model = null)
    {
        try {
            $sql = "insert into pessoa (nome_pessoa, telefone_pessoa, celular_pessoa, email_pessoa, cep, logradouro,
            numero, complemento, bairro,cidade, uf, login_pessoa,
             senha_pessoa, status, tipo_pessoa) 
            values (:nome_pessoa, :telefone_pessoa, :celular_pessoa, :email_pessoa, :cep,
             :logradouro, :numero, :complemento, :bairro, :cidade, :uf,
             :login_pessoa, :senha_pessoa, :status, :tipo_pessoa)";

            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":nome_pessoa", $model->getNome_pessoa());
            $stmt->bindValue(":telefone_pessoa", $model->getTelefone_pessoa());
            $stmt->bindValue(":celular_pessoa", $model->getCelular_pessoa());
            $stmt->bindValue(":email_pessoa", $model->getEmail_pessoa());
            $stmt->bindValue(":cep", $model->getCep());
            $stmt->bindValue(":logradouro", $model->getLogradouro());
            $stmt->bindValue(":numero", $model->getNumero());
            $stmt->bindValue(":complemento", $model->getComplemento());
            $stmt->bindValue(":bairro", $model->getBairro());
            $stmt->bindValue(":cidade", $model->getCidade());
            $stmt->bindValue(":uf", $model->getUf());
            $stmt->bindValue(":login_pessoa", $model->getLogin_pessoa());
            $stmt->bindValue(":senha_pessoa", md5($model->getSenha_pessoa())); //..hash md5 to protect 
            $stmt->bindValue(":status", $model->getStatus());
            $stmt->bindValue(":tipo_pessoa", $model->getTipo_pessoa());
            $stmt->execute();
            return $this->connection->lastInsertId('sid_pessoa');
            //$ultimoid = $stmt->fetch(\PDO::FETCH_ASSOC);           
            //return $ultimoid;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    // nome_pessoa varchar(70) not null,
    // telefone_pessoa varchar(15),
    // celular_pessoa varchar(15),
    // email_pessoa varchar(50),
    // cep varchar(9),
    // logradouro varchar(50),
    // numero integer,
    // complemento varchar(70),
    // bairro varchar(50),
    // cidade varchar(50),
    // uf char(2),
    // login_pessoa varchar(16) not null,
    // senha_pessoa text not null,

    public function update(PessoaModel $model = null)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "update \"user\" set name = :name, gender = :gender, email = :email, 
                    password = :password, status = :status, type = :type, photo = :photo 
                    where id = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":name", $model->getName());
            $stmt->bindValue(":gender", $model->getGender());
            $stmt->bindValue(":email", $model->getEmail());
            $stmt->bindValue(":password", md5($model->getPassword())); //..hash md5 to protect the password
            $stmt->bindValue(":status", $model->getStatus());
            $stmt->bindValue(":type", $model->getType());
            $stmt->bindValue(":photo", $model->getPhoto());
            return $stmt->execute();
        } catch (\Exception $ex) {
            throw $ex;
        } finally {
            $connection = null;
        }
    }

    public function activateUser($email)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "update pessoa set status = 'A' where email_pessoa = :email";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":email", $email);
            return $stmt->execute();
        } catch (\Exception $ex) {
            throw $ex;
        } finally {
            $connection = null;
        }
    }

    public function delete($id)
    {
        //..needless    
    }

    public function findById($id)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "select * from \"user\" where id = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":id", $id);
            $result = $stmt->execute();
            $result = $stmt->fetchAll();
            if ($result) {
                $result = $result[0];
                return new UserModel(
                    $result['id'],
                    $result['name'],
                    $result['gender'],
                    $result['email'],
                    $result['status'],
                    $result['type'],
                    $result['photo']
                );
            } else {
                return null;
            }
        } catch (\Exception $ex) {
            throw $ex;
        } finally {
            $connection = null;
        }
    }

    public function select(
        $criteria = null,
        $orderBy = 'name',
        $limit = null,
        $offSet = null
    ) {
        try {
            $connection = Connection::getConnection();
            $sql = "select * from \"user\" ";
            if ($criteria)
                $sql .= " where $criteria ";
            if ($limit)
                $sql .= " limit $limit ";
            if ($offSet)
                $sql .= " offset $offSet ";
            $stmt = $connection->prepare($sql);
            $result = $stmt->execute();
            $result = $stmt->fetchAll();
            if ($result) {
                $list = new \ArrayObject();
                foreach ($result as $row) {
                    $list->append(
                        new CategoryModel(
                            $row['id'],
                            $row['name'],
                            $row['gender'],
                            $row['email'],
                            $row['status'],
                            $row['type'],
                            $row['photo']
                        )
                    );
                }
                return $list;
            } else {
                return null;
            }
        } catch (\Exception $ex) {
            throw $ex;
        } finally {
            $connection = null;
        }
    }

    public function selectCount($criteria = null)
    {
        try {
            $conn = Connection::getConnection();
            $sql = "select count(*) from \"user\" where $criteria";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute();
            $result = $stmt->fetchAll();
            if ($result)
                return $result[0]['count'];
            else
                return 0;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function doLogin($login_pessoa, $senha_pessoa)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "select * from pessoa where status = 'A' and upper(login_pessoa) = upper(:login_pessoa) and senha_pessoa = md5(:senha_pessoa)";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":login_pessoa", $login_pessoa);
            $stmt->bindValue(":senha_pessoa", $senha_pessoa);
            $result = $stmt->execute();
            $result = $stmt->fetchAll();
            if ($result) {
                $result = $result[0];
                return new PessoaModel(
                    $result['id_pessoa'],
                    $result['nome_pessoa'],
                    $result['telefone_pessoa'],
                    $result['celular_pessoa'],
                    $result['email_pessoa'],
                    $result['cep'],
                    $result['logradouro'],
                    $result['numero'],
                    $result['complemento'],
                    $result['bairro'],
                    $result['cidade'],
                    $result['uf'],
                    $result['login_pessoa'],
                    $result['senha_pessoa'],
                    $result['status'],
                    $result['tipo_pessoa']
                );
            } else {
                return null;
            }
        } catch (\Exception $ex) {
            throw $ex;
        } finally {
            $connection = null;
        }
    }

    public function LastId()
    { }
}
