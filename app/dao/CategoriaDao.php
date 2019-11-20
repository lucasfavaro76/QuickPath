<?php
namespace app\dao;


use core\dao\Connection;
use core\dao\IDao;

use app\model\CategoriaModel;

class CategoriaDao implements IDao
{
    /**
     * Persists a model in database
     */
    public function insert(CategoriaModel $model = null)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "insert into categoria (nome_categoria, id_restaurante) values (:nome_categoria, :id_restaurante)";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":nome_categoria", $model->getNome_categoria());
            $stmt->bindValue(":id_restaurante", $model->getId_restaurante());           
            return $stmt->execute();
        } catch (\Exception $ex) {
            throw $ex;
        } finally {
            $connection = null;
        }
    }

    public function update(CategoriaModel $model = null)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "update cargo set nome_categoria = :nome_categoria where id_categoria = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":id", $model->getId());
            $stmt->bindValue(":nome_categoria", $model->getNome_categoria());           
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
            $sql = "delete from categoria where id_categoria = :id";
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
            $sql = "select * from categoria where id_categoria = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":id", $id);
            $result = $stmt->execute();
            $result = $stmt->fetchAll();
            if ($result) {
                $result = $result[0];
                return new CategoriaModel(
                    $result['id_categoria'],
                    $result['nome_categoria'],
                    $result['id_restaurante']
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

    public function select($criteria = null, $orderBy = 'nome_categoria', 
        $limit = null, $offSet = null)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "select * from categoria ";
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
                        new CategoriaModel(
                            $row['id_categoria'],
                            $row['nome_categoria']
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
            $sql = "select count(*) from categoria where $criteria";
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
