<?php

namespace app\dao;

use app\model\EnderecoModel;
use core\dao\IDao;
use app\model\PessoaModel;
use core\dao\Connection;

final class EnderecoDao implements IDao
{

    public function insert(EnderecoModel $model = null)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "insert into endereco (cep, logradouro, numero, complemento, bairro, cidade, uf) values (:cep, :logradouro, :numero, :complemento, :bairro, :cidade, :uf) RETURNING id_endereco";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":cep", $model->getCep());
            $stmt->bindValue(":logradouro", $model->getLogradouro());
            $stmt->bindValue(":numero", $model->getNumero());
            $stmt->bindValue(":complemento", $model->getComplemento());
            $stmt->bindValue(":bairro", $model->getBairro());
            $stmt->bindValue(":cidade", $model->getCidade()); //..hash md5 to protect the password
            $stmt->bindValue(":uf", $model->getUf());                    
            $stmt->execute();

            return $ultimoid =  $stmt->fetch(\PDO::FETCH_ASSOC);
           
            // cep character varying(9),
            // logradouro character varying(50),
            // numero integer,
            // complemento character varying(70),
            // bairro character varying(50),
            // cidade character varying(50),
            // uf character(2),
            
        } catch (\Exception $ex) {
            throw $ex;
        } finally {
            $connection = null;
        }
    }


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
            $sql = "update \"user\" set status = 'A' where email = :email";
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

    public function doLogin($email, $password)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "select * from \"user\" where status = 'A' and upper(email) = upper(:email) and password = md5(:password)";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":email", $email);
            $stmt->bindValue(":password", $password);
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

    public function LastId()
    {
        
    }
}
