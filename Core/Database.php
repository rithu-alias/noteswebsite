<?php

namespace Core;
use PDO;
use PDOException;

class Database{
    protected $pdo;
    public $connection;
    public $statement;
    public function __construct($config){
       
        $dsn = 'mysql:'.(http_build_query($config,'',';'));
        $username = 'root';
        $password = '';
        $this->connection = new PDO($dsn, $username, $password);
        
    }
    public function query($query,$params = []){

        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);


        return $this;
    }

    public function get(){
        return $this->statement->fetchAll();
    }

    public function find(){
        return $this->statement->fetch();
    }
    public function findORfail(){
        $result = $this->find();
        if(! $result){
            abort();
        }
        else{
            return $result;
        }
    }
  
    


}
