<?php

$uri = $_SERVER['REQUEST_URI'];
$uriArr = explode('/', $uri);
$datas = category::find($uriArr[count($uriArr)-1]);
foreach($datas as $data){
    echo $data['id']." ++++ ".$data['name']."<br>";
}