<?php

namespace app\dao;

use app\model\PessoaFisicaModel;
use app\model\PessoaJuridicaModel;
use core\dao\IDao;
use app\model\PessoaModel;
use core\dao\Connection;

final class PessoaJuridicaDao extends PessoaDao
{

    public function insert(PessoaModel $model = null)
    {
        try {
            $this->connection->beginTransaction();
            $id = parent::insert($model);
            $sql = "insert into pessoa_juridica (id_juridica, cnpj_juridica, razao_social, descricao, imagem) values (:id_juridica, :cnpj_juridica, :razao_social, :descricao,:imagem )";
            $stmt = $this->connection->prepare($sql);

            $stmt->bindValue(":id_juridica", $id);
            $stmt->bindValue(":cnpj_juridica", $model->getCnpj_juridica());
            $stmt->bindValue(":razao_social", $model->getRazao_social());
            $stmt->bindValue(":descricao", $model->getDescricao());            
            $stmt->bindValue(":imagem", $model->getImagem());
            $stmt->execute();
            $this->connection->commit();
        } catch (\Exception $ex) {
            $this->connection->rollBack();
            throw $ex;
        } finally {
            $connection = null;
        }
        // cnpj_juridica varchar(18) not null UNIQUE,
        // razao_social varchar(70) not null UNIQUE,
        // id_pessoa integer,
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
        //..needless    
    }

    public function findById($id)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "select * from pessoa p inner join pessoa_juridica pj on p.id_pessoa = pj.id_juridica where p.id_pessoa = :id";
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
                    $result['cnpj_juridica'],
                    $result['razao_social'],
                    $result['descricao'],
                    $result['login_pessoa'],
                    null,
                    $result['status'],
                    $result['tipo_pessoa'],
                    $result['imagem']
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

    public function selectAll()
    {
        try {
            $connection = Connection::getConnection();
            $sql = "select * from pessoa p inner join pessoa_juridica pj on p.id_pessoa = pj.id_juridica where p.status = 'A' ";
            $stmt = $this->connection->prepare($sql);
            $result = $stmt->execute();
            $result = $stmt->fetchAll();
            if ($result) {
                $list = new \ArrayObject();
                foreach ($result as $row) {
                    $list->append(
                        new PessoaJuridicaModel(
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
                            $row['cnpj_juridica'],
                            $row['razao_social'],
                            $row['descricao'],
                            $row['login_pessoa'],
                            null,
                            $row['status'],
                            $row['tipo_pessoa'],
                            $row['imagem']
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


    public function select(
        $criteria = null,
        $orderBy = 'name',
        $limit = null,
        $offSet = null
    ) {
        try {
            $connection = Connection::getConnection();
            $sql = "select * from pessoa p inner join pessoa_juridica pj on p.id_pessoa = pj.id_pessoa";
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
                        new PessoaJuridicaModel(
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
                            $row['cnpj_juridica'],
                            $row['razao_social'],
                            $row['descricao'],
                            $row['login_pessoa'],
                            null,
                            $row['status'],
                            $row['tipo_pessoa'],
                            $row['imagem']
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
