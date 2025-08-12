<?php

$uri = $_SERVER['REQUEST_URI'];
$uriArr = explode("/", $uri);
$id = $uriArr[3];
product::delete($id);