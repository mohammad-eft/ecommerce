<?php

class mainDB{
    private $server="localhost";
    private $user="root";
    private $pass="";
    private $DBName="ecommerce";
    protected $connection;
    protected static $table;
    public function __construct(){
        $this -> connection  = new mysqli($this -> server, $this -> user, $this -> pass, $this -> DBName);
    }
    // public function all(){
    //     $query = "SELECT * FROM {$this -> table}";
    //     return $this -> connection -> query($query);
    // }
    // public function find($id){
    //     $query = "SELECT * FROM {$this -> table} WHERE id=".$id;
    //     return $this -> connection -> query($query);
    // }
    // public function delete($id){
    //     $query = "DELETE FROM {$this -> table} WHERE id=".$id;
    //     return $this -> connection -> query($query);
    // }
}