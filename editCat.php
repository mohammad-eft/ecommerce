<?php

$uri = $_SERVER['REQUEST_URI'];
$uriArr = explode('/', $uri);
$x = category::find($uriArr[count($uriArr)-1]);
$id=$uriArr[3];
// echo $uriArr[2];
$data = $x->fetch_assoc()
// var_dump($x->fetch_assoc());

?>
<h1 class="text-center font-bold text-xl text-gray-700 mt-10">Edit Category Form</h1>
<form action="http://localhost/ecommerce/updateCatFormData" method="post" class="w-1/2 m-auto mt-20 border rounded-lg shadow p-10"> 
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="flex flex-col">
        <label for="name" class="mr-5 text-md font-semibold text-gray-700">Name : </label>
        <input type="text" name="name" id="name" class="outline-none border-b px-10 py-2 mb-2" value="<?= $data['name'] ?>" required>
    </div>

    <button class="px-10 py-3 border rounded-md mt-5">submit</button>
</form>