<?php

// class factory{
//     public static $obj=[]; 
//     public static function factory($className, $parametr = null){
//         if (!in_array($className, self::$obj)) {
//             if ($parametr) {
//                 self::$obj[$className]=new $className($parametr);
//                 return self::$obj[$className];
//             }
//             self::$obj[$className]=new $className;
//             return self::$obj[$className];
//         }
//         return self::$obj[$className];
//     }
// }
class factory{
    public static $obj=[]; 
    public static function factory($className, $parametr = null){
        if (!isset(self::$obj[$className])) {
            self::$obj[$className]=new $className($parametr);
        }
        return self::$obj[$className];
    }
}