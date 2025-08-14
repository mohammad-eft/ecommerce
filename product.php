<a href="http://localhost/ecommerce/productForm" style="display: block; font-size: 30px; font-weight: 700; color: gray;">product form</a>

<?php
$uri = $_SERVER['REQUEST_URI'];
$uriArr = explode("/", $uri);
if ($uriArr[count($uriArr)-2] == 'page') {

    // without with method
/*
    
    if (!$_POST) {
        $mmd = product::select()->pagenate($uriArr[4]);
        while($row = $mmd->fetch_assoc()){
            echo $row['id'], " +++++ ", $row['name'], " __ ", $row['price'];
            ?>
            <a href="http://localhost/ecommerce/editPro/<?= $row['id']; ?>" style="color: green;">edit</a>
            <a href="http://localhost/ecommerce/deletePro/<?= $row['id']; ?>" style="color: red;">delete</a>
            <a href="http://localhost/ecommerce/showPro/<?= $row['id']; ?>" style="color: blue;">show</a>
            </br>
            <?php
        }
        $num = 1;
        $all = product::all();
        $count = $all->num_rows;
        for ($i=0; $i < $count / 5; $i++) { 
            ?>
            <a href="http://localhost/ecommerce/product/page/<?= $num; ?>"><?= $num; ?></a>
            <?php
            $num++;
        }
    }
*/

    // with with methoe

    // if (!$_POST) {
    //     $d = $model::select(['*'])->with(['category_name' => ['category', 'name']])->get();
    //     // var_dump($model['name']);
        
    //     while($a = $d->fetch_assoc()){
    //         echo $a['id'],"+++++",$a['name']," ____ ",$a['price'], " ___ ", $a['category_name']."<br>";
    //         // var_dump($data);
    //     }
    // }


    if (!$_POST) {
        $x = product::select()->category(['category_name'=>'name', 'category_id'=>'id'])->pagenate($uriArr[4]);
        // $x = product::select()->category(['category_name'=>'name', 'category_id'=>'id'])->get();
        while($a = $x->fetch_assoc()){
            echo $a['id'],"+++++",$a['name']," ____ ",$a['price'], " ___ ", $a['category_name'], " ____ ", $a["category_id"];
            ?>
            <a href="http://localhost/ecommerce/editPro/<?= $a['id']; ?>" style="color: green;">edit</a>
            <a href="http://localhost/ecommerce/deletePro/<?= $a['id']; ?>" style="color: red;">delete</a>
            <a href="http://localhost/ecommerce/showPro/<?= $a['id']; ?>" style="color: blue;">show</a>
            </br>
            <?php
        }
        
        $num = 1;
        $all = product::all();
        $count = $all->num_rows;
        for ($i=0; $i < $count / 5; $i++) {
            ?>
            <a href="http://localhost/ecommerce/product/page/<?= $num; ?>"><?= $num; ?></a>
            <?php
            $num++;
        }
            
    }

    
    if ($_POST) {
        $rows = product::where($_POST['where_field'], $_POST['from'], ">=")->where($_POST['where_field'], $_POST['to'], "<=")->sort($_POST['sort'], $_POST['field']);
        foreach($rows as $row){
            echo $row['id'], " +++++ ", $row['name'], " __ ", $row['price'];
            ?>
            <a href="http://localhost/ecommerce/editPro/<?= $row['id']; ?>" style="color: green;">edit</a>
            <a href="http://localhost/ecommerce/deletePro/<?= $row['id']; ?>" style="color: red;">delete</a>
            <a href="http://localhost/ecommerce/showPro/<?= $row['id']; ?>" style="color: blue;">show</a>
            </br>
            <?php
        }
        /*
        $num = 1;
        $all = product::all();
        $count = $rows->num_rows;
        for ($i=0; $i < $count / 5; $i++) {
            ?>
            <a href="http://localhost/ecommerce/product/price/page/<?= $num; ?>/<?= $_POST['start']?>/<?= $_POST['end'] ?>"><?= $num; ?></a>
            <?php
            $num++;
        }
            */
    }
}
?>

<form action="http://localhost/ecommerce/product/page/1" method="post">
    <div style="margin-top: 10px">
        <label for="sort">sort:</label>
        <select min="0" name="sort" id="sort" style="border:1px solid black;">
            <option value="asc">asc</option>
            <option value="desc">desc</option>
        </select>
    </div>
    <div style="margin-top: 10px; margin-bottom: 10px;">
        <label for="field">field:</label>
        <select name="field" id="field" style="border:1px solid black;">
            <option value="id">id</option>
            <option value="price">price</option>
          ?>
        </select>
    <div style="margin-top: 10px; margin-bottom: 10px;">
        <label for="where_field">where_field:</label>
        <select name="where_field" id="where_field">
            <option value="id">id</option>
            <option value="price">price</option>
        </select>
    </div>
    <div style="margin-top: 10px">
        <label for="from">from:</label>
        <input type="number" min="0" name="from" id="from">
    </div>
    <div style="margin-top: 10px; margin-bottom: 10px;">
        <label for="to">to:</label>
        <input type="number" min="0" name="to" id="to">
    </div>
    </div>
    <button style="martin-top: 30px; border: 1px solid black; padding: 5px;">submit</button>
</form>