<?php

define('ROOT', dirname(__DIR__));

require './class/autoloader.class.php';
Autoloader::register();

$config = Config::getInstance();
$db = new Mysql($config->dbInfo("hostname"), $config->dbInfo('username'), 
    $config->dbInfo('password'), $config->dbInfo('port'), $config->dbInfo('db'));
?>