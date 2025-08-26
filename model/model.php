<?php

class model extends builderFacade{

    protected $query;
    protected $type;
    protected $base;
    private static $model = null;
    protected $group;
    protected $limit;
    protected $having;

    protected function create($data){
        $value="(";
        $field="(";
        $num = 0;
        foreach($data as $key => $value_field){ 
            $num++;
            $field.=$key;
            $value.="'$value_field'";
            if ($num<count($data)) {
                $field.=",";
                $value.=",";
            }
        }

        $value.=")";
        $field.=")";
        $table = static::$table;
        $query = "INSERT INTO {$table} $field VALUES $value";
        return factory::factory(static::class)->get($query);
    }

    protected function find($id){
        $table = static::$table;
        $model = factory::factory(static::class);
        self::select()->where("id", $id);
        return $model->get();
    }

    protected function update($data){
        $model=factory::factory(static::class);
        $model->type="update";
        $table = static::$table;
        foreach($data[0] as $key => $value){
            if ($key != "id") {
                $field[]="$key='$value'";
            }
        }
        $model->query = "UPDATE {$table} SET ";
        $num = 0;
        foreach($field as $value){
            $num++;
            $model->query.=$value;
            if ($num<count($field)) {
                $model->query.=", ";
            }
        }
        $model->where('id',$data[0]['id']);
        return $model->get();
    }

    protected function delete($id){
        $table = static::$table;
        $query = $this->query = "DELETE FROM {$table} WHERE id=".$id[0];
        // echo __METHOD__.$query;
        return $this->get();
    }

    protected function all(){
        $model = factory::factory(static::class);
        $model -> type="all";
        $table = static::$table;
        $query = "SELECT * FROM " . $table;
        $model -> query = $query;
        return $model->get($query);
    }

    protected function select(array $fields=["*"]){
        $model = factory::factory(static::class);
        $model -> query = "SELECT ";
        $x = 0;
        foreach($fields as $table => $datas){
            $num = 0;
            if (is_array($datas)) {
                foreach($datas as $data){
                    $model->query.=$table.".".$data." ".$table."_".$data." ";
                    $num++;
                    if($num<count($datas)){
                        $model->query.=", ";
                    }
                }
                $x++;
                if ($x<count($fields)) {
                    $model->query.=", ";
                }
            }
            if (!is_array($datas)) {
                $model->query .= $datas;
            }
        }
        $model -> type = "select";
        return $model;
    }


    protected function with(array $data){
        
        $model = factory::factory(static::class);
        $table = static::$table;
        if (static::class == "product") {
            if (!$model -> type) {
                $model::select([$table=>['id', 'name', 'price'], $data[0]=>['id', 'name']]);
            }
        }
        if (static::class == "category") {
            if (!$model -> type) {
                $model::select([$table=>['id', 'name'], $data[0]=>['id', 'name', 'price']]);
            }
        }
        $model->join($data[0], $data[1]);
        return $model;
    }
    
    protected function join(string $data, string $join){
        $table = static::$table;
        $this -> base = " {$join} JOIN $data";
        foreach($this -> relatedTo as $tableName => $value){
            $query = $this -> where($table.".".$value[0], $tableName.".".$value[1])->getSql();
        }
        return $query;
    }

    protected function groupBy(string $field){
        $this -> group=" GROUP BY {$field}";
        return $this;
    }

    protected function belongsTo(string $table, array $fields){
        $this -> type = "belongsTo";
        $this_table = static::$table;
        foreach ($fields as $alias => $field) {
            foreach($this -> relatedTo as $key => $value){
               $this -> query .= ", ( " . $table::select([$field])->from()->where($this_table.".".$this -> relatedTo[$table][0], $table.".".$this -> relatedTo[$table][1])->getSql() . " ) " . $alias;
            }
        }
        return $this;
    }
    
    protected function from(){
        $table = static::$table;
        $this -> from = " FROM {$table} ";
        return $this;
    }

    protected function count(){
        $model = factory::factory(static::class);
        self::select(['COUNT(*)']);
        return $model;
    }

    protected function countSubQuery(string $table, array $fields){
        $this_table = static::$table;
        $table=factory::factory($table);
        $fields=$fields[0];
        foreach ($fields as $alias => $tableName) {
         
            foreach ($this -> relatedTo as $key => $value) {
                $this -> subQuery = " ,( ". $table->count()->where($key.".".$value[1], $this_table.".".$value[0])->getSql() . " ) " . $alias;
            }
        }
        return $this;
    }

    protected function having(string $field, int $value, string $operator="="){
        $this->having=" HAVING {$field} {$operator} {$value}";
        return $this;
    }
    

     protected function getSql(){
        $query = $this -> query;
        if ($this -> type != "all") {
            if (static::class == "category") {
                if (isset($this -> subQuery)) {
                    $query .= $this -> subQuery;
                }
            }
            if ($this->type == "select") {
                $this -> from();
                $query .=$this ->from;
            }
            if ($this -> base) {
                $query.=$this->base;
            }
            if (!empty($this -> where)) {
                if (!$this->base) {
                    $query.=" WHERE ".implode(" AND ", $this->where);
                }
                if ($this->base) {
                    $query.= " ON ".implode(" AND ", $this->where);
                }
            }
            if ($this->group) {
                $query.=$this->group;
            }
            if ($this->having) {
                $query.=$this->having;
            }
            if ($this->limit) {
                $query.=$this->limit;
            }
        }
        
        return $query;
    }

    protected function get(){
            $query = $this -> getSql();
            echo $query."<br>";
            echo $this->type;
            return $this -> connection -> query($query);
    }

    
    protected function where($field, $value, $operator="="){
        $model = factory::factory(static::class);
        if (!in_array($model -> type, ['select', 'delete', 'update'])) {
            throw new \Exception('ارورون وار عزیز');
        }
        if (is_array($value)) {
            $model -> where []= "$field $operator $value[0]";
            return $model;
        }
        $model -> where []= "$field $operator $value";
        return $model;
    }

    protected function limit($offset, $numberOfRows){
       if (!in_array($this->type, ['select'])) {
            throw new \Exception("LIMIT can only be added to SELECT");
        }
        $this->limit = " LIMIT " . $offset . ", " . $numberOfRows;
        return $this;
    }
    
    protected function pagenate(array $num){
        $offset = ($num[0] - 1) * 5;
        $this -> limit($offset, 5);
        return $this->get();

    }

    protected function sort(string $sort, string $field){
        $data = $this->get();
        $datas = [];
        foreach($data as $y){
            $datas[]=$y;
        }
        foreach($datas as $data){
            for ($i=0; $i < count($datas)-1; $i++) { 
                if ($sort == "asc") {
                    if ($datas[$i][$field]>$datas[$i+1][$field]) {
                        $index = $datas[$i+1];
                        $datas[$i+1]=$datas[$i];
                        $datas[$i]=$index;
                    }
                }
                if ($sort == "desc") {
                    if ($datas[$i][$field]<$datas[$i+1][$field]) {
                        $index = $datas[$i+1];
                        $datas[$i+1]=$datas[$i];
                        $datas[$i]=$index;
                    }
                }
            }
        }

        return $datas;
    }
}