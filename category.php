
<a href="http://localhost/ecommerce/categoryForm" style="display: block; color: gray; font-size: 30px; font-weight: 700;">category form</a>

<?php
/*
$x = category::all();
while($row=$x->fetch_assoc()){
    echo $row['id']." ++++ ".$row['name'];
    ?>
    
    <a href="http://localhost/ecommerce/editCat/<?= $row['id']; ?>" style="color: green;">edit</a>
    <a href="http://localhost/ecommerce/deleteCat/<?= $row['id']; ?>" style="color: red;">delete</a>
    <a href="http://localhost/ecommerce/showCat/<?= $row['id']; ?>" style="color: blue;">show</a>
    
    </br>

    <?php
}
    */

$x = category::select()->withCount(['product_count'=>'product'])->get();

while($row=$x->fetch_assoc()){
    echo $row['id']." ++++ ".$row['name']." ____ ".$row['product_count'];
    ?>
    
    <a href="http://localhost/ecommerce/editCat/<?= $row['id']; ?>" style="color: green;">edit</a>
    <a href="http://localhost/ecommerce/deleteCat/<?= $row['id']; ?>" style="color: red;">delete</a>
    <a href="http://localhost/ecommerce/showCat/<?= $row['id']; ?>" style="color: blue;">show</a>
    
    </br>

    <?php
}
