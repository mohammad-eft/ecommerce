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
}