<?php

namespace app\dao;

use app\model\PessoaFisicaModel;
use app\model\PessoaJuridicaModel;
use core\dao\IDao;
use app\model\PessoaModel;
use core\dao\Connection;
use app\dao\PessoaDao;

final class PessoaFisicaDao extends PessoaDao
{


    public function insert(PessoaModel $model = null)
    {                
        try {
            $this->connection->beginTransaction();
            $id = parent::insert($model);                            
            $sql = "insert into pessoa_fisica (id_pessoa, cpf_fisica) values (:id_pessoa, :cpf_fisica)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":id_pessoa", $id);
            $stmt->bindValue(":cpf_fisica", $model->getCpf_fisica());                               
            $stmt->execute();
            $this->connection->commit();           
        } catch (\Exception $ex) {            
            $this->connection->rollBack();
            throw $ex;
        } finally {
            $connection = null;
        }
    }


    public function update(PessoaModel $model = null)
    {
        try {
            $this->connection->beginTransaction();
            $sql = "update pessoa_fisica set cpf_fisica = :cpf_fisica where id_pessoa = :id";

            $stmt = $this->connection->prepare($sql);

            $stmt->bindValue(":cpf_fisica", $model->getCpf_fisica());
            $stmt->bindValue(":id", $model->getId());

            if (parent::update($model)) {
                $stmt->execute();
                $this->connection->commit();
                return true;
            } else {
                $this->connection->rollBack();
                return false;
            }
        } catch (\Exception $ex) {
            $this->connection->rollBack();
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
        try {

            $this->connection->beginTransaction();
            $sql = "delete from pessoa_fisica where id_pessoa = :id_pessoa";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":id_pessoa", $id);
            $stmt->execute();

            parent::delete($id);

            $this->connection->commit();
            
        } catch (\Exception $ex) {
            $this->connection->rollBack();
            throw $ex;
        } finally {
            $connection = null;
        }
    }

    public function findById($id)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "select * from pessoa p inner join pessoa_fisica pf on p.id_pessoa = pf.id_pessoa  where p.id_pessoa = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":id", $id);
            $result = $stmt->execute();
            $result = $stmt->fetchAll();
            if ($result) {
                $result = $result[0];
                return new PessoaFisicaModel(
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
                    $result['cpf_fisica'],
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
                        new PessoaModel(
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
}
