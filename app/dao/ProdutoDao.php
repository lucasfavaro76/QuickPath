<?php

namespace app\dao;

use app\model\PessoaFisicaModel;
use app\model\PessoaJuridicaModel;
use core\dao\IDao;
use app\model\PessoaModel;
use app\model\ProdutoModel;
use core\dao\Connection;

class ProdutoDao implements IDao
{

    protected $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function insert(ProdutoModel $model = null)
    {
        try {
            $sql = "insert into produto (nome_produto, unidade_produto, preco_produto, quant_estoque, id_categoria, id_restaurante, imagem ) 
            values (:nome_produto, :unidade_produto, :preco_produto, :quant_estoque, :id_categoria, :id_restaurante, :imagem)";

            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":nome_produto", $model->getNome_produto());
            $stmt->bindValue(":unidade_produto", $model->getUnidade_produto());
            $stmt->bindValue(":preco_produto", $model->getPreco_produto());
            $stmt->bindValue(":quant_estoque", $model->getQuant_estoque());
            $stmt->bindValue(":id_categoria", $model->getCategoria()->getId());
            $stmt->bindValue(":id_restaurante", $model->getId_restaurante());
            $stmt->bindValue(":imagem", $model->getImagem());
            return $stmt->execute();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function update(ProdutoModel $model = null)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "update produto set nome_produto = :nome_produto, unidade_produto = :unidade_produto, preco_produto = :preco_produto, quant_estoque = :quant_estoque, id_categoria = :id_categoria, id_restaurante = :id_restaurante, imagem = :imagem 
                    where id_produto = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":nome_produto", $model->getNome_produto());
            $stmt->bindValue(":unidade_produto", $model->getUnidade_produto());
            $stmt->bindValue(":preco_produto", $model->getPreco_produto());
            $stmt->bindValue(":quant_estoque", $model->getQuant_estoque());
            $stmt->bindValue(":id_categoria", $model->getCategoria()->getId());
            $stmt->bindValue(":id_restaurante", $model->getId_restaurante());            
            $stmt->bindValue(":imagem", $model->getImagem());
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
            $sql = "delete from produto where id_produto = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":id", $id);
            return $stmt->execute();
        } catch (\Exception $ex) {
            throw $ex;
        } finally {
            $connection = null;
        }
    }

    public function findById($id)
    {
        try {
            $connection = Connection::getConnection();
            $sql = "select * from produto p inner join categoria c on p.id_categoria = c.id_categoria where id_produto = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":id", $id);
            $result = $stmt->execute();
            $result = $stmt->fetchAll();
            if ($result) {
                $result = $result[0];
                return new ProdutoModel(
                    $result['id_produto'],
                    $result['nome_produto'],
                    $result['unidade_produto'],
                    $result['preco_produto'],
                    (new CategoriaDao())->findById($result['id_categoria']),
                    $result['id_restaurante'],
                    $result['quant_estoque'],
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

    public function select(
        $criteria = null,
        $orderBy = 'name',
        $limit = null,
        $offSet = null
    ) {
        try {
            $connection = Connection::getConnection();
            $sql = "select * from produto p inner join categoria c on p.id_categoria = c.id_categoria ";
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
                        new ProdutoModel(
                            $row['id_produto'],
                            $row['nome_produto'],
                            $row['unidade_produto'],
                            $row['preco_produto'],
                            (new CategoriaDao())->findById($row['id_categoria']),
                            $row['id_restaurante'],
                            $row['quant_estoque'],
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
