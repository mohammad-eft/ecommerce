<?php

class autoLoad{
    public static function load($className){
        $class = $className.".php";
        if ($className == 'factory') {
            $class = "factory/".$class;
        }
        if ($className == 'mainDB' || $className == 'product' || $className == 'category' || $className == 'usery' || $className == 'model') {
            $class = "model/".$class;
        }
        if (file_exists($class)) {
            include "$class";
        } else {
            die("class $className not exists");
        }
    }
}

spl_autoload_register(['autoLoad', 'load']);