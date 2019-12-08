<?php

namespace app\dao;


use core\dao\Connection;
use core\dao\IDao;
use app\model\CargoModel;
use app\model\MesaModel;

class MesaDao implements IDao
{

    protected $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Persists a model in database
     */
    public function insert(MesaModel $model = null)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "insert into mesa (numero_mesa, id_funcionario  ,id_restaurante, data, hora,id_pessoa) values (:numero_mesa, :id_funcionario , :id_restaurante, :data, :hora, :id_pessoa)";
            $stmt = $connection->prepare($sql);

            $stmt->bindValue(":numero_mesa", $model->getNumero_mesa()->getId());
            $stmt->bindValue(":id_funcionario", $model->getId_funcionario());
            $stmt->bindValue(":id_restaurante", $model->getId_restaurante()->getId());
            $stmt->bindValue(":data", $model->getData());
            $stmt->bindValue(":hora", $model->getHora());
            $stmt->bindValue(":id_pessoa", $model->getId_pessoa()->getId());
            return $stmt->execute();
        } catch (\Exception $ex) {
            throw $ex;
        } finally {
            $connection = null;
        }
    }

    public function update(MesaModel $model = null)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "update cargo set nome_cargo = :nome_cargo where id_cargo = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":id", $model->getId());
            $stmt->bindValue(":nome_cargo", $model->getNumero_mesa());
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
            $connection = Connection::getConnection();
            $sql = "delete from mesa where id_mesa = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":id", $id);
            return $stmt->execute();
        } catch (\Exception $ex) {
            throw $ex;
        } finally {
            $connection = null;
        }
    }

    /**
     * This method retrieves a model object from data base 
     * using an 'id' as input parameter.
     */
    public function findById($id)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "select * from mesa m inner join pessoa p on m.id_pessoa = p.id_pessoa where m.id_mesa = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":id", $id);
            $result = $stmt->execute();
            $result = $stmt->fetchAll();
            if ($result) {
                $result = $result[0];
                return new MesaModel(
                    $result['id_mesa'],
                    (new NumMesaDao($this->connection))->findById($result['numero_mesa']),
                    $result['id_funcionario'],
                    (new PessoaDao($this->connection))->findById($result['id_pessoa']),
                    (new PessoaJuridicaDao($this->connection))->findById($result['id_restaurante']),
                    $result['data'],
                    $result['hora']
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
        $orderBy = 'numero_mesa',
        $limit = null,
        $offSet = null
    ) {
        try {
            $connection = Connection::getConnection();
            $sql = "select * from mesa m inner join pessoa p on m.id_pessoa = p.id_pessoa ";
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
                        new MesaModel(
                            $row['id_mesa'],
                            (new NumMesaDao($this->connection))->findById($row['numero_mesa']),
                            $row['id_funcionario'],
                            (new PessoaDao($this->connection))->findById($row['id_pessoa']),
                            (new PessoaJuridicaDao($this->connection))->findById($row['id_restaurante']),
                            $row['data'],
                            $row['hora']
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
            $sql = "select count(*) from cargo where $criteria";
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
