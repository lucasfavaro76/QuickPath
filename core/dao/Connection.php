<?php
namespace core\dao;

class Connection
{
    // /**
    //  * The name of the database
    //  */
    // const DBNAME = 'lucasfavaro76';
    // /**
    //  * the user name
    //  */
    // const USER = 'lucasfavaro76';
    // /**
    //  * the password
    //  */
    // const PASSWORD = 'deadinside2017';
    // /**
    //  * The host of the database. by default it is '127.0.0.1' or 'localhost'
    //  */
    // const HOST = 'projetos.fatecjales.edu.br';
    // /**
    //  * The port of the databse. The Postgres default port is 5432.
    //  */
    // const PORT = 5432;

    /**
     * The name of the database
     */
    const DBNAME = 'bd_QuickPath';
    /**
     * the user name
     */
    const USER = 'postgres';
    /**
     * the password
     */
    const PASSWORD = '123456';
    /**
     * The host of the database. by default it is '127.0.0.1' or 'localhost'
     */
    const HOST = 'localhost';
    /**
     * The port of the databse. The Postgres default port is 5432.
     */
    const PORT = 5432;

    /**
     * Retorna um objeto PDO para fazer a conexão com o banco de dados.
     * @return \PDO
     * @throws \PDOException
     */
    public static function getConnection()
    {
        try {
            //..Instantiate a new PDO object
            $connection = new \PDO("pgsql:dbname=" . self::DBNAME . 
                ";user=" . self::USER . ";password=" . self::PASSWORD . 
                ";host=" . self::HOST . ";port=" . self::PORT);
            //..set it to generate exceptions in case of errors
            $connection->setAttribute(
                \PDO::ATTR_ERRMODE,
                \PDO::ERRMODE_EXCEPTION
            );
            //..returns a PDO object
            return $connection;
        } catch (\PDOException $ex) {
            $connection = null;
            throw $ex;
        }
    }
}

