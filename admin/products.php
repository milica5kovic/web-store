<?php
global $pdo;
session_start();

if (!isset($_SESSION['user']['status']) || !$_SESSION['user']['status']) {
    header('location: /admin/login.php');
    exit();
}

require_once '../db.php';

require_once '../functions/products.php';
require_once '../functions/categories.php';

$categories = fetchCategories($pdo);

$products = fetchProducts($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'modules/header.php'; ?>
<div class="m-4">
    <div class="row">
        <div class="col-md-9">
            <div class="table-responsive mt-4">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Creator</th>
                        <th>Marked</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <td><?= $product['id'] ?></td>
                            <td><?= $product['name'] ?></td>
                            <td><?= $product['description'] ?></td>
                            <td><?= $product['category_name'] ?></td>
                            <td><?= $product['price'] ?></td>
                            <td><?= $product['stock'] ?></td>
                            <td><?= $product['username'] ?></td>
                            <td><?= $product['mark'] ?></td>
                            <td>
                                <a href="updateProduct.php?id=<?= $product['id'] ?>">
                                    <button class="btn btn-warning btn-sm">Update</button>
                                </a>
                                <a href="jobs/deleteProduct.php?id=<?= $product['id'] ?>">
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-4 shadow mt-4">
                <h4 class="text-center mb-3">Add Product</h4>
                <form action="jobs/addProduct.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription" name="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price</label>
                        <input min="0" type="number" class="form-control" id="productPrice" name="price" step=".1"
                               required>
                    </div>
                    <div class="mb-3">
                        <label for="productStock" class="form-label">Stock</label>
                        <input min="0" type="number" class="form-control" id="productStock" step="1" name="stock"
                               required>
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Image</label>
                        <input type="file" class="form-control" id="productImage" name="image">
                    </div>
                    <div class="mb-3">
                        <label for="cat">Category</label>
                        <select name="category" id="cat" class="form-control" required>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

