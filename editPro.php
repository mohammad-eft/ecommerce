<?php

$uri = $_SERVER['REQUEST_URI'];
$uriArr = explode("/", $uri);
$id = $uriArr[3];
$x = product::find($id);
$row = $x->fetch_assoc();
?>

<h1 class="text-center font-bold text-xl text-gray-700 mt-10">Edit Product Form</h1>
<form action="http://localhost/ecommerce/updateProFormData" method="post" class="w-1/2 m-auto mt-20 border rounded-lg shadow p-10">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <div class="flex flex-col">
        <label for="name" class="mr-5 text-md font-semibold text-gray-700">Name : </label>
        <input type="text" name="name" id="name" class="outline-none border-b px-10 py-2 mb-2" value="<?= $row['name']; ?>" required>
    </div>
    <div class="flex flex-col">
        <label for="description" class="mr-5 text-md font-semibold text-gray-700">Description : </label>
        <input type="text" name="description" id="description" class="outline-none border-b px-10 py-2 mb-2" value="<?= $row['description']; ?>" required>
    </div>
    <div class="flex flex-col">
        <label for="price" class="mr-5 text-md font-semibold text-gray-700">Price : </label>
        <input type="text" name="price" id="price" class="outline-none border-b px-10 py-2 mb-2" value="<?= $row['price']; ?>" required>
    </div>
    <div class="flex flex-col">
        <label for="categoryId" class="mr-5 text-md font-semibold text-gray-700">Category : </label>

        <select type="text" name="categoryId" id="categoryId" class="outline-none border-b px-10 py-2 mb-2" required>
        <?php 
            $x = category::all();
            while($cat = $x->fetch_assoc()){
        ?>
            <option value="<?= $cat['id']; ?>" <?php if($cat['id'] == $row['categoryId']){ echo 'selected'; } ?>><?= $cat['name']; ?></option>
        <?php
        }
        ?>
        </select>

    </div>
    <div class="flex flex-row items-center">
        <label for="exist" class="mr-5 text-md font-semibold text-gray-700">Exist : </label>
        <input type="checkbox" name="exist" id="exist" class="outline-none border-b px-10 py-2 mb-2" value="exist" <?php if($row['exist']=="exist"){ echo "checked"; } ?> >
    </div>
    <button class="px-10 py-3 border rounded-md mt-5">submit</button>
</form>