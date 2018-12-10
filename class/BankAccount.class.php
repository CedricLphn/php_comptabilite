<?php


class BankAccount {
    private $data;

    public function getAccountInfo() {
        $config = new Config();
        
        // Test
        var_dump(Mysql::getDB()->prepare("SELECT * FROM operation WHERE id_operation = ?", [2])->fetch()->nom_operation);
    }
}