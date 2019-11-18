<?php

namespace app\dao;
use core\dao\IDao;

use app\model\VendasModel;
use core\dao\Connection;

class VendasDao implements IDao
{

    protected $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function insert(VendasModel $model = null)
    {
        try {
            $sql = "insert into venda (preco_total, data_venda,hora_venda, tipo_pagamento, id_funcionario, id_restaurante, id_pessoa, id_produto ) 
            values (:preco_total, :data_venda, :hora_venda, :tipo_pagamento, :id_funcionario, :id_restaurante, :id_pessoa, :id_produto)";

            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":preco_total", $model->getPreco_total());
            $stmt->bindValue(":data_venda", $model->getData_venda());
            $stmt->bindValue(":hora_venda", $model->getHora_venda());
            $stmt->bindValue(":tipo_pagamento", $model->getTipo_pagamento());
            $stmt->bindValue(":id_funcionario", $model->getId_funcionario());
            $stmt->bindValue(":id_restaurante", $model->getId_restaurante());
            $stmt->bindValue(":id_pessoa", $model->getId_pessoa());
            $stmt->bindValue(":id_produto", $model->getId_produto());
            return $stmt->execute();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    // <!-- id_venda integer NOT NULL DEFAULT nextval('sid_venda'::regclass),
    // preco_total numeric(10,2) NOT NULL,
    // data_venda character varying(12),
    // hora_venda character varying(10),
    // tipo_pagamento character varying(20),
    // id_funcionario integer,
    // id_restaurante integer,
    // id_pessoa integer,
    // id_produto integer, -->

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

    public function select()
    {
        try {
            $connection = Connection::getConnection();
            $sql = "select p.id_pessoa, preco_total, data_venda, hora_venda, tipo_pagamento,nome_produto, preco_produto, quantidade, p.nome_pessoa, cpf_fisica ,p.email_pessoa from venda v inner join pessoa_juridica pj on pj.id_juridica = v.id_restaurante inner join pessoa p on v.id_pessoa = p.id_pessoa inner join pessoa_fisica pf on p.id_pessoa = pf.id_pessoa inner join produto pr on v.id_produto = pr.id_produto  ";
            $stmt = $connection->prepare($sql);
            $result = $stmt->execute();
            $result = $stmt->fetchAll();
            if ($result) {
                $list = new \ArrayObject();
                 foreach ($result as $row) {
                $list->append($row);
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
