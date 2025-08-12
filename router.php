<?php

class router{
    private $uri;
    private $uriArr;
    public function __construct($uri){
        $this -> uri = $uri;
    }
    public function parsUri(){
        $this -> uriArr = explode("/", $this -> uri);
    }
    public function getUriArr(){
        return $this -> uriArr;
    }
}