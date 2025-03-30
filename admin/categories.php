<?php
global $pdo;
session_start();

if(!isset($_SESSION['user']['status']) || !$_SESSION['user']['status']){
    header('location: /admin/login.php');
    exit();
}

require_once '../db.php';

require_once '../functions/categories.php';

$categories = fetchCategories($pdo);

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
<div class="container mt-4">
    <form action="jobs/addCategory.php" method="post">
        <h3>Create new category</h3>
        <div class="mb-3">
            <label for="categoryName" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="categoryName" name="name" placeholder="Category 1" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary w-100">Add new</button>
    </form>
    <br>
    <br>
    <h3>Category listing</h3>
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Creator</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($categories as $category): ?>
            <tr>
                <td class="id"><?= $category['id'] ?></td>
                <td class="name"><?= $category['name'] ?></td>
                <td class="user"><?= $category['username'] ?></td>
                <td class="action">
                    <button id="updateButton" data-id="<?= $category['id'] ?>" class="update btn btn-warning btn-sm">Update</button>
                    <a href="jobs/deleteCategory.php?id=<?= $category['id'] ?>"><button class="btn btn-danger btn-sm">Delete</button></a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const buttons = document.getElementsByClassName('update');

    Array.from(buttons).forEach((el) => {
        el.addEventListener("click", function update(e) {
            const target = e.currentTarget;
            const parent = target.parentElement.parentElement;
            const name = parent?.querySelector('.name');
            if (!name) {
                console.error("Element with class 'name' not found in parent", parent);
                return;
            }

            const originalText = name.innerHTML;
            name.innerHTML = `<input type="text" required value="${originalText}">`;
            target.innerHTML = 'Save';
            target.removeEventListener("click", update);

            target.addEventListener("click", (e) => {
                const target = e.currentTarget;
                const id = target.dataset.id;
                const name = target.parentElement.parentElement.querySelector("input").value;

                location.replace(`./jobs/updateCategory.php?id=${id}&name=${name}`);
            });

        });
    });

</script>

</body>
</html>

