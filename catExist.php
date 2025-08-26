<?php

if ($_POST['category']=="with") {
    $datas = category::with('product', true)->withCount(['product_count'=>'product'])->groupBy("category.id")->get();
    foreach($datas as $data){
        echo $data['category_id']." ++++ ".$data['category_name']." ________ ".$data['product_count']."<br>";
    }
}

if ($_POST['category']=="without") {
    $rows = category::withCount(['product_count'=>'product'])->having("product_count", 0)->get();
    foreach($rows as $row){
        echo $row['id']." ++++ ".$row['name']." ________ ".$row['product_count']."<br>";
    }
}