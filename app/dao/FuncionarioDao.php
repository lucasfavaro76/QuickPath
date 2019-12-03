<?php

namespace app\dao;

use app\model\PessoaFisicaModel;
use app\model\PessoaJuridicaModel;
use core\dao\IDao;
use app\model\PessoaModel;
use core\dao\Connection;
use app\dao\PessoaDao;
use app\model\FuncionarioModel;

final class FuncionarioDao extends PessoaDao
{

    public function insert(PessoaModel $model = null)
    {
        try {
            $this->connection->beginTransaction();
            $id = parent::insert($model);
            $sql = "insert into funcionario (id_funcionario, id_cargo, salario ,id_restaurante, cpf_funcionario) 
            values (:id_pessoa, :id_cargo, :salario ,:id_restaurante,:cpf_funcionario)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":id_pessoa", $id);
            $stmt->bindValue(":id_cargo", $model->getCargo()->getId());
            $stmt->bindValue(":salario", $model->getSalario());
            $stmt->bindValue(":id_restaurante", $model->getId_juridica());
            $stmt->bindValue(":cpf_funcionario", $model->getCpf_funcionario());
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
    public function delete($id)
    {

        try {

            $this->connection->beginTransaction();
            $sql = "delete from funcionario where id_funcionario = :id_pessoa";
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
            $sql = "select * from pessoa p inner join pessoa_juridica pj on p.id_pessoa = pj.id_juridica  where id_pessoa = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":id", $id);
            $result = $stmt->execute();
            $result = $stmt->fetchAll();
            if ($result) {
                $result = $result[0];
                return new PessoaJuridicaModel(
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
                    (new CargoDao($this->connection))->findById($result['id_cargo']),
                    $result['salario'],
                    $result['id_restaurante'],
                    $result['login_pessoa'],
                    null,
                    $result['status'],
                    $result['tipo_pessoa'],
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
        $orderBy = null,
        $limit = null,
        $offSet = null
    ) {
        try {
            $connection = Connection::getConnection();
            $sql = "select * from pessoa p inner join funcionario f on p.id_pessoa = f.id_funcionario ";
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
                        new FuncionarioModel(
                            $row['id_pessoa'],
                            $row['nome_pessoa'],
                            $row['telefone_pessoa'],
                            $row['celular_pessoa'],
                            $row['email_pessoa'],
                            $row['cep'],
                            $row['logradouro'],
                            $row['numero'],
                            $row['complemento'],
                            $row['bairro'],
                            $row['cidade'],
                            $row['uf'],
                            (new CargoDao($this->connection))->findById($row['id_cargo']),
                            $row['salario'],
                            $row['id_restaurante'],
                            $row['cpf_funcionario'],
                            $row['login_pessoa'],
                            null,
                            $row['status'],
                            $row['tipo_pessoa'],
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
