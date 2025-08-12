<?php

class product extends model{
    protected static $table = "product";
    protected $relatedTo = ['category'=>['categoryId', 'id']];
    public function category($fields){
        $this -> belongsTo(category::class, $fields);
        return $this;
    }
    // public function create($data){
    //     $name = $data['name'];
    //     $description = $data['description'];
    //     $price = $data['price'];
    //     $categoryId = $data['categoryId'];
    //     if(isset($data['exist'])){
    //         $exist = $data['exist'];
    //     }
    //     if (!isset($data['exist'])) {
    //         $exist = 'not exist';
    //     }
    //     $query = "INSERT INTO product(name, description, price, categoryId, exist)VALUES($name, $description, $price, $categoryId, $exist)";
    //     return $this -> connection -> query($query);
    // }
    // public function update($data){
    //     $id = $data['id'];
    //     $name = $data['name'];
    //     $description = $data['description'];
    //     $price = $data['price'];
    //     $categoryId = $data['categoryId'];
    //     if(isset($data['exist'])){
    //         $exist = $data['exist'];
    //     }
    //     if (!isset($data['exist'])) {
    //         $exist = 'not exist';
    //     }
    //     $query = "UPDATE product SET name='$name', description='$description', price='$price', categoryId='$categoryId', exist='$exist'WHERE id=".$id;
    //     return $this -> connection -> query($query);
    // }
}