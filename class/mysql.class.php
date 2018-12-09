<?php

class Mysql {
    
    private $db;
    private $pdo;
    
    function __construct(string $host = "localhost", string $username = "root", string $pwd = null, int $port, string $db)
    {
        $this->db = [
            "host" => $host,
            "username" => $username,
            "passwd" => $pwd,
            "port" => $port,
            "database" => $db
        ];

        $this->getPdo();
        
        return true;
    }

    private function getPdo() {
        if($this->pdo == null) {
            try {
                $this->pdo = new PDO(
                    "mysql:host=".$this->db['host'].";port=".$this->db['port'].";dbname=".$this->db['database']."",
                    $this->db['username'],
                    $this->db['passwd'],
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            }catch(Exception $e) {
                return Config::info($e);
            }
        }

        return $this->pdo;
    }

}