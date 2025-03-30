<?php
global $pdo;
require_once './db.php';
require_once './functions/products.php';
require_once './dirmap.php';
require_once './functions/categories.php';
$marked = fetchMarkedProducts($pdo);
$categories = fetchCategories($pdo);
$newest = newestProducts($pdo);
$products = fetchProducts($pdo);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title> Mia5ko </title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
    <link href="css/font-awesome.min.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet"/>
    <link href="css/responsive.css" rel="stylesheet"/>
    <style>
        .navbar {
            background: #1e1371;
            padding: 20px;
        }
    </style>
</head>
<body>
<?php include './modules/header.php'; ?>
<div class="container mt-lg-5 mb-lg-5">
    <h1 class="mt-lg-5 mb-lg-5">Newly added products</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($newest as $key => $product): ?>
            <div class="col">
                <div class="card <?php echo $key === 0 ? 'border-primary shadow-lg' : ''; ?>">
                    <img src="<?php echo $product['image_url']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['name']; ?></h5>
                        <p class="card-text"><strong><?php echo $product['price']; ?></strong></p>
                        <a href="/product.php?id=<?= $product['id'] ?>" class="btn btn-primary">See more</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="container mt-lg-5 mb-lg-5">
    <h1 class="mt-lg-5 mb-lg-5">We recommend</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($marked as $key => $product): ?>
            <div class="col">
                <div class="card <?php echo $key === 0 ? 'border-primary shadow-lg' : ''; ?>">
                    <img src="<?php echo $product['image_url']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['name']; ?></h5>
                        <p class="card-text"><strong><?php echo $product['price']; ?></strong></p>
                        <a href="/product.php?id=<?= $product['id'] ?>" class="btn btn-primary">See more</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php foreach ($categories as $key => $category): ?>
    <div class="container mt-lg-5 mb-lg-5">
        <h1 class="mt-lg-5 mb-lg-5"><?= $category['name'] ?></h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($products as $key => $product): ?>
                <?php if ($product['category'] === $category['id']): ?>
                    <div class="col">
                        <div class="card <?=  $key === 0 ? 'border-primary shadow-lg' : ''; ?>">
                            <img src="<?= $product['image']; ?>" class="card-img-top"
                                 alt="<?= $product['name']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?=  $product['name']; ?></h5>
                                <p class="card-text"><strong><?=  $product['price']; ?></strong></p>
                                <a href="/product.php?id=<?= $product['id'] ?>" class="btn btn-primary">See more</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>

<?php include './modules/footer.php'; ?>
</body>
</html>
