<?php

class category extends model{
    protected static $table = "category";
    protected $relatedTo = ['product'=>['id', 'categoryId']];
    
    protected function withCount(array $fields){
        $model = factory::factory(static::class);
        if ($model->type!="select") {
            $select = $this->select();
        }
        $model -> countSubQuery(product::class, $fields);
        return $model;
    }
}