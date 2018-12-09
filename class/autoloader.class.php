<?php

class Autoloader {

    static function register() {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload($class){
        $explode = explode('\\', $class);
        require './class/'.$class.'.class.php';
    }
}
?>