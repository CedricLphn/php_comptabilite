<?php

class BankAccount {
    private $data;
    private $config;
    private $tpl;

    function __construct() {
        $this->tpl = new TemplateManager();
        $this->tpl->setContent("home.php");
        Config::info($this->tpl);
        $this->getAccountInfo();
    }

    public function getAccountInfo() {
        $test = "ok";
        $this->tpl->show();
       //return Mysql::getDB()->prepare("SELECT * FROM operation WHERE id_operation = ?", [2])->fetch();
    }
}