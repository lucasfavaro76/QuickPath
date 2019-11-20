<?php
namespace app\dao;


use core\dao\Connection;
use core\dao\IDao;
use app\model\CargoModel;

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
    public function insert(CargoModel $model = null)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "insert into cargo (nome_cargo, id_restaurante) values (:nome_cargo, :id_restaurante)";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":nome_cargo", $model->getNome_cargo());           
            $stmt->bindValue(":id_restaurante", $model->getId_restaurante());
            return $stmt->execute();
        } catch (\Exception $ex) {
            throw $ex;
        } finally {
            $connection = null;
        }
    }

    public function update(CargoModel $model = null)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "update cargo set nome_cargo = :nome_cargo where id_cargo = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":id", $model->getId());
            $stmt->bindValue(":nome_cargo", $model->getNome_cargo());           
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
            $sql = "delete from cargo where id_cargo = :id";
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
            $sql = "select * from cargo where id_cargo = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":id", $id);
            $result = $stmt->execute();
            $result = $stmt->fetchAll();
            if ($result) {
                $result = $result[0];
                return new CategoriaModel(
                    $result['id'],
                    $result['nome_cargo']                    
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

    public function select($criteria = null, $orderBy = 'nome_cargo', 
        $limit = null, $offSet = null)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "select * from cargo ";
            if($criteria)
                $sql .= " where $criteria ";
            if($limit)
                $sql .= " limit $limit ";
            if($offSet)
                $sql .= " offset $offSet ";
            $stmt = $connection->prepare($sql);                                             
            $result = $stmt->execute();            
            $result = $stmt->fetchAll();
            if ($result) {
                $list = new \ArrayObject();
                foreach ($result as $row) {
                    $list->append(
                        new CargoModel(
                            $row['id_cargo'],
                            $row['nome_cargo']
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
