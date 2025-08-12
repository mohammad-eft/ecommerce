<?php

$uri = $_SERVER['REQUEST_URI'];
$uriArr = explode("/", $uri);
$id = $uriArr[3];
$x = product::find($id);
$row = $x->fetch_assoc();
$y = category::find($row['categoryId']);
$cat = $y->fetch_assoc();
echo $row['id'], " ++++ ", $row['description'], " __ ", $row['price'], " __ ", $cat['name'], " __ ", $row['exist'];