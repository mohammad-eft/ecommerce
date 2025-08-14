<?php

class category extends model{
    protected static $table = "category";
    protected $relatedTo = ['product'=>['id', 'categoryId']];
    
    public function withCount(array $fields){
        $this -> countSubQuery(product::class, $fields);
        return $this;
    }
    // public function create($data){
    //     $name = $data['name'];
    //     $query = "INSERT INTO category(name)VALUES($name)";
    //     return $this -> connection -> query($query);
    // }
    // public function update($data){
    //     $id = $data['id'];
    //     $name = $data['name'];
    //     $query = "UPDATE category SET name='$name' WHERE id=".$id;
    //     return $this -> connection -> query($query);
    // }
}