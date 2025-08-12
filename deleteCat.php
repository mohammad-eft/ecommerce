<?php
$uri = $_SERVER['REQUEST_URI'];
$uriArr = explode('/', $uri);
$id=$uriArr[3];
category::delete($id);
// echo $uriArr[2]," " , $uriArr[3],"</br>";
// $data = $x->fetch_assoc()