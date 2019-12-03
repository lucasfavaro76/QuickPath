<?php

namespace app\dao;


use core\dao\Connection;
use core\dao\IDao;
use app\model\CargoModel;
use app\model\NumMesaModel;

class NumMesaDao implements IDao
{

    protected $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Persists a model in database
     */
    public function insert(NumMesaModel $model = null, $tipo = null)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "insert into num_mesa (numero_mesa, id_restaurante, mesa_ocupada) values (:numero_mesa, :id_restaurante, :mesa_ocupada)";
            $stmt = $connection->prepare($sql);

            if ($tipo == "intervalo") {
                for ($i = 1; $i <= $model->getNum_mesa(); $i++) {

                    $stmt->bindValue(":numero_mesa", $i);
                    $stmt->bindValue(":id_restaurante", $model->getId_restaurante());
                    $stmt->bindValue(":mesa_ocupada", $model->getMesa_ocupada());

                    $stmt->execute();
                }
            } else {
                // $sql = "insert into num_mesa (numero_mesa, id_restaurante) values (:numero_mesa, :id_restaurante)";
                // $stmt = $connection->prepare($sql);
                $stmt->bindValue(":numero_mesa", $model->getNum_mesa());
                $stmt->bindValue(":id_restaurante", $model->getId_restaurante());
                $stmt->bindValue(":mesa_ocupada", $model->getMesa_ocupada());
                $stmt->execute();
            }


            return $stmt;
        } catch (\Exception $ex) {
            throw $ex;
        } finally {
            $connection = null;
        }
    }

    public function update(NumMesaModel $model = null)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "update num_mesa set numero_mesa = :numero_mesa where id_num_mesa = :id";
            $stmt = $connection->prepare($sql);           
            $stmt->bindValue(":numero_mesa", $model->getNum_mesa());
            $stmt->bindValue(":id", $model->getId());
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
            $sql = "delete from num_mesa where id_num_mesa = :id";
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
            $sql = "select * from num_mesa where id_num_mesa = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":id", $id);
            $result = $stmt->execute();
            $result = $stmt->fetchAll();
            if ($result) {
                $result = $result[0];
                return new NumMesaModel(
                    $result['id_num_mesa'],
                    $result['numero_mesa'],
                    $result['id_restaurante'],
                    $result['mesa_ocupada']
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
        $limit = null,
        $offSet = null
    ) {
        try {
            $connection = Connection::getConnection();
            $sql = "select * from num_mesa where mesa_ocupada = 'L' and ";
            if ($criteria)
                $sql .= " $criteria ";
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
                        new NumMesaModel(
                            $row['id_num_mesa'],
                            $row['numero_mesa'],
                            $row['id_restaurante'],
                            $row['mesa_ocupada']
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
