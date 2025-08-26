<?php

class builderFacade extends mainDB{
    public static function __callStatic($method, $args=null){
        $model = factory::factory(static::class);
        return $model->$method($args);
    }
    public function __call($method, $args=null){
        return $this->$method($args);
    }
}