<?php

class model extends mainDB{

    protected $query;
    protected $type;
    protected $base;
    private static $model = null;

    public static function create($data){
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

    public static function find($id){
        $table = static::$table;
        $query = "SELECT * FROM {$table} WHERE id = ".$id;
        return factory::factory(static::class)->get($query);
    }

    public static function update($data){
      
        $table = static::$table;
        foreach($data as $key => $value){
            if ($key != "id") {
                $field[]="$key='$value'";
            }
        }
        $query = "UPDATE {$table} SET ";
        $num = 0;
        foreach($field as $value){
            $num++;
            $query.=$value;
            if ($num<count($field)) {
                $query.=", ";
            }
        }
        $query.=" WHERE id=".$data['id'];
        return factory::factory(static::class)->get($query);
    }

    public static function delete($id){
        $table = static::$table;
        $query = "DELETE FROM {$table} WHERE id=".$id;
        return factory::factory(static::class)->get($query);
    }

    public static function all(){
        $table = static::$table;
        $model = factory::factory(static::class);
        $query = "SELECT * FROM " . $table;
        $model -> query = $query;
        return $model->get($query);
    }

    public static function select(array $fields=["*"]){
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


    public static function with(string $data){
        
        $model = factory::factory(static::class);
        $table = static::$table;
        if (static::class == "product") {
            if (!$model -> type) {
                $model::select([$table=>['id', 'name', 'price'], $data=>['id', 'name']]);
            }
        }
        if (static::class == "category") {
            if (!$model -> type) {
                $model::select([$table=>['id', 'name'], $data=>['id', 'name', 'price']]);
            }
        }
        $model->type='with';
        $model->join($data, true);
        return $model;
    }
    
    public function join(string $data, bool $bool=true){
        $table = static::$table;
        if (static::class == 'product') {
            if ($bool) {
                $this -> base = " LEFT JOIN $data";
                foreach($this -> relatedTo as $tableName => $value){
                    $query = $this -> where($table.".".$value[0], $tableName.".".$value[1])->getSql();
                }
            }
            if (!$bool) {
                echo "😂😂😂";
                $this -> base = " LEFT JOIN $data";
                foreach($this -> relatedTo as $tableName => $value){
                    $query = $this -> where($table.".".$value[0], 0)->getSql();
                }
            }
        }
        if (static::class == 'category') {
            $this -> base = " INNER JOIN $data";
            foreach($this -> relatedTo as $tableName => $value){
                $query = $this -> where($table.".".$value[0], $tableName.".".$value[1])->getSql();
            }
        }
        return $query;
    }

    public function belongsTo(string $table, array $fields){
        $this -> type = "belongsTo";
        $this_table = static::$table;
        foreach ($fields as $alias => $field) {
            foreach($this -> relatedTo as $key => $value){
               $this -> query .= ", ( " . $table::select([$field])->from()->where($this_table.".".$this -> relatedTo[$table][0], $table.".".$this -> relatedTo[$table][1])->getSql() . " ) " . $alias;
            }
        }
        return $this;
    }
    
    public function getSql(){
        $query = $this -> query;
        if ($this->type != "with") {
            if (!empty($this -> where)) {
                $query.= " WHERE ".implode(" AND ", $this -> where);
            }
            $this->where = [];
            if (isset($this->limit)) {
                $query .= $this->limit;
            }
        }
        if ($this->type == "with") {
            if (!empty($this -> where)) {
                $this -> from();
                $this -> base .= " ON ".implode(" AND ", $this -> where);
            }
            $this->query .= $this -> base;
        }
        return $query;
    }
    
    public function from(){
        $table = static::$table;
        $this -> query .= " FROM {$table}";
        return $this;
    }

    public static function count(){
        $model = factory::factory(static::class);
        $model -> type = 'select';
        $model -> query .= "SELECT count(*)";
        return $model;
    }

    public function countSubQuery(string $table, array $fields){
        $this -> type = "countSubQuery";
        $this_table = static::$table;
        foreach ($fields as $alias => $tableName) {
            foreach ($this -> relatedTo as $key => $value) {
                $this -> query .= " ,( ". $table::count()->from()->where($key.".".$value[1], $this_table.".".$value[0])->getSql() . " ) " . $alias;
            }
        }
        return $this;
    }
    
    public function get(?string $code = null){
        if (!$code) {
            $query = $this -> query;
            if ($this->type != "with") {
                if (!empty($this -> where)) {
                    $query.= " WHERE ".implode(" AND ", $this -> where);
                }
                if (isset($this->limit)) {
                    $query .= $this->limit;
                }
                if (in_array($this -> type, ['belongsTo', 'countSubQuery'])) {
                    $this->from();
                    return $this -> connection -> query($this->query);
                }
                if (!empty($this -> where)) {
                    $this->query.= " WHERE ".implode(" AND ", $this -> where);
                }
            }
            return $this -> connection -> query($query);
        }
        return $this -> connection -> query($code);
    }

    
    public static function where($field, $value, $operator="="){
        $model = factory::factory(static::class);
        if ($model->type != "with") {
            if ($model -> type != "select" && !self::$model) {
                $select = self::select();
                $model -> from();
                self::$model = $select;
            }
            if (!in_array($model -> type, ['select', 'delete', 'update'])) {
                throw new \Exception('ارورون وار عزیز');
            }
        }
        $model -> where []= "$field $operator $value";
        return $model;
    }

    public function limit($offset, $numberOfRows){
       if (!in_array($this->type, ['select'])) {
            throw new \Exception("LIMIT can only be added to SELECT");
        }
        $this->limit = " LIMIT " . $offset . ", " . $numberOfRows;
        return $this;
    }
    
    public function pagenate(int $num){

        $offset = ($num - 1) * 5;
        $query = $this -> query.=" LIMIT ".$offset.", 5";
        return $this->connection->query($query);

    }

    public function sort(string $sort, string $field){
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