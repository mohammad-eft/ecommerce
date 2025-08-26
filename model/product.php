<?php

class product extends model{
    protected static $table = "product";
    protected $relatedTo = ['category'=>['categoryId', 'id']];
    protected function category($fields){
        $this -> belongsTo(category::class, $fields);
        return $this;
    }
}