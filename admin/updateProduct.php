<?php
global $pdo;
session_start();

if (!isset($_SESSION['user']['status']) || !$_SESSION['user']['status']) {
    header('location: ./login.php');
    exit();
}

require_once '../db.php';
require_once '../functions/products.php';
require_once '../functions/categories.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $product = fetchProduct($pdo, $id);
    $categories = fetchCategories($pdo);
} else {
    header('location: ./admin/products.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/pvtk21pe4n8sugkutyeid599lzctfcw1nyyn2pfu3izpo683/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: [
                // Core editing features
                'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
                // Your account includes a free trial of TinyMCE premium features
                // Try the most popular premium features until Apr 13, 2025:
                'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
            ],
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
            ],
            max_height: 320,
            min_height: 100,
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
        });
    </script>
</head>
<body>
<?php include 'modules/header.php'; ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card p-4 shadow-sm">
                <h3>Change Image</h3>
                <div class="text-center">
                    <img src="../images/<?= $product['image'] ?>" alt="Product Image" class="img-fluid mb-3" style="max-height: 300px; object-fit: cover;">
                    <form action="./jobs/changeImage.php?id=<?= $product['id'] ?>" method="post" enctype="multipart/form-data">
                        <label for="image" class="form-label">Choose New Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                        <button type="submit" class="btn btn-primary w-100 mt-2">Change</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4 shadow-sm">
                <h3>Edit Product</h3>
                <form action="./jobs/updateProduct.php?id=<?= $product['id'] ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $product['name'] ?>" placeholder="Ultra mega max vukadin" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Product Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required><?= $product['description'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" value="<?= $product['stock'] ?>" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="<?= $product['price'] ?>" min="0" step=".1" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select name="category" id="category" class="form-control" required>
                            <option value="null">None</option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category['id'] ?>" <?= ($category['id'] == $product['category']) ? 'selected' : ''; ?>><?= $category['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="mark" type="checkbox" id="flexSwitchCheckDefault" <?php echo ($product['mark'] == 1) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="flexSwitchCheckDefault">Mark this product as recommended</label>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary w-100">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
