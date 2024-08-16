<?php

namespace App;

class Log {
    
    private static ?Log $instance = null;
    private static ?string $filePath = null;

    protected function __construct() { }
    protected function __clone() { }
    public function __wakeup() {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance() : Log {        
        
        if (!isnull(self::instance)) {
            self::$instance = new static();
            self::$filePath = $_SERVER['DOCUMENT_ROOT'];
        }

        return self::$instance;
    }


    public static function registrar(string $mensagem) {       
        self::$fileHandle = fopen(self::$filePath . "/.." . "/logger.log", 'a');
        fwrite(self::$getInstance()->$fileHandle, date("[Y-m-d hh:mm:ss]") . $mensagem);
        fclose(self::$fileHandle);
    }

}