<?php

if ($_POST['type'] == "!empty") {
    $datas = category::with("product")->get();
    foreach ($datas as $data) {
        echo $data['category_id'], " ", $data['category_name'], " ", $data['product_name'], "</br>";
    }
}

if ($_POST['type'] == "empty") {
    $datas = product::where("categoryId", 0)->get();
    foreach ($datas as $data) {
        echo $data['id'], " +++ ", $data['name'], " ___ ", $data['categoryId'];
        echo  "</br>";
    }
}