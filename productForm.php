<h1 class="text-center font-bold text-xl text-gray-700 mt-10">Product Form</h1>
<form action="http://localhost/ecommerce/getProductFormData" method="post" class="w-1/2 m-auto mt-20 border rounded-lg shadow p-10">
    <div class="flex flex-col">
        <label for="name" class="mr-5 text-md font-semibold text-gray-700">Name : </label>
        <input type="text" name="name" id="name" class="outline-none border-b px-10 py-2 mb-2" required>
    </div>
    <div class="flex flex-col">
        <label for="description" class="mr-5 text-md font-semibold text-gray-700">Description : </label>
        <input type="text" name="description" id="description" class="outline-none border-b px-10 py-2 mb-2" required>
    </div>
    <div class="flex flex-col">
        <label for="price" class="mr-5 text-md font-semibold text-gray-700">Price : </label>
        <input type="text" name="price" id="price" class="outline-none border-b px-10 py-2 mb-2" required>
    </div>
    <div class="flex flex-col">
        <label for="categoryId" class="mr-5 text-md font-semibold text-gray-700">Category : </label>

        <select type="text" name="categoryId" id="categoryId" class="outline-none border-b px-10 py-2 mb-2">
            <option value="0">without category</option>
        <?php 
            $x = category::all();
            while($row = $x->fetch_assoc()){
        ?>
            <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
        <?php
        }
        ?>
        </select>

    </div>
    <div class="flex flex-row items-center">
        <label for="exist" class="mr-5 text-md font-semibold text-gray-700">Exist : </label>
        <input type="checkbox" name="exist" id="exist" class="outline-none border-b px-10 py-2 mb-2" value="exist">
    </div>
    <button class="px-10 py-3 border rounded-md mt-5">submit</button>
</form>