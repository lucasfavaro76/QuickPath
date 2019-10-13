<?php
namespace app\dao;

use app\model\CategoriaModel;
use core\dao\Connection;
use core\dao\IDao;

class CategoriaDao implements IDao
{
    /**
     * Persists a model in database
     */
    public function insert(CategoryModel $model = null)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "insert into categoria (nome_categoria) values (:nome_categoria)";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":name", $model->getName());           
            return $stmt->execute();
        } catch (\Exception $ex) {
            throw $ex;
        } finally {
            $connection = null;
        }
    }

    public function update(CategoryModel $model = null)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "update categoria set nome_categoria = :nome_categoria where id_categoria = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":id", $model->getId());
            $stmt->bindValue(":name", $model->getNome_categoria());           
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
                    $result['id'],
                    $result['nome_categoria']                    
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
                            $row['id'],
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
