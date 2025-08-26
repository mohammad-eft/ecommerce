<?php

class factory{
    public static $obj=[]; 
    public static function factory($className, $parametr = null){
        if (!isset(self::$obj[$className])) {
            self::$obj[$className]=new $className($parametr);
        }
        return self::$obj[$className];
    }
}