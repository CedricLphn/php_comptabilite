<?php

class Config {

    private $config;
    private static $_instance;

    public function __construct(?string $filename = null) {
        if($this->config != null)
            return true;

        require(($filename == null) ? 'config.php' : $filename);
        $this->config["site"] = $config;
        $this->config["mysql"] = $mysql;
        
        return true;
    }

    public static function getInstance(?string $filename = null) : Config {
        if(self::$_instance == null){
            self::$_instance = new Config($filename);
        }
        
        return self::$_instance;
    }

    public function get(string $type, $key) {
        return $this->config[$type][$key];
    }

    public function dbInfo($key) {
        return $this->get('mysql', $key);
    }

    public static function info($message) {
        if(!self::getInstance()->get('site', 'prod')) {
            echo "<pre>";
            var_dump($message);
            echo "</pre>";
        }

        return $message;
    }

}

?>