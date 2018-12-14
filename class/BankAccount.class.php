<?php

class BankAccount {
    private $data;
    private $config;
    private $tpl;

    function __construct() {
        $this->tpl = new TemplateManager();
        $this->tpl->setContent("home.php");
        $this->getAccountInfo();
    }

    public function getAccountInfo() {
        $test = "ok";
        $this->tpl->set(array("test" => "hello world"));
        $this->tpl->set(array("testddd" => array("test")));
        $this->tpl->show();
        Config::info($this->tpl);

       //return Mysql::getDB()->prepare("SELECT * FROM operation WHERE id_operation = ?", [2])->fetch();
    }
}