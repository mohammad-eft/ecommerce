<?php

include "header.php";
include "autoLoad.php";

$loadFile = factory::factory('loadFile');
$uri = $_SERVER['REQUEST_URI'];

$route = factory::factory('router', $uri);
$route->parsUri();
$uriArr = $route->getUriArr();
if (count($uriArr)==3 && $uriArr[2]=="") {
    $loadFile->loadFile("home");
}
if (count($uriArr)>=3 && $uriArr[2]!="") {
    $loadFile->loadFile($uriArr[2]);
}
