<?php

$uri = $_SERVER['REQUEST_URI'];
$uriArr = explode('/', $uri);
$x = category::find($uriArr[count($uriArr)-1]);
$id=$uriArr[3];
$data = $x->fetch_assoc();
echo $data['id'], "  ++++++  ", $data['name'];