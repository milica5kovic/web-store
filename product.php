<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('Location: ./catalogue.php');
    exit();
}

global $pdo;
require_once './db.php';
require_once './functions/products.php';
require_once './dirmap.php';
require_once './functions/categories.php';
$marked = fetchMarkedProducts($pdo);
$newest = newestProducts($pdo);
$product = fetchProduct($pdo, $id);
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

<div class="container mt-5 mb-5">
    <div class="row align-items-center">

        <div class="col-md-6">
            <h1 class="fw-bold"><?= $product['name'] ?></h1>
            <p class="lead"><?= $product['description'] ?></p>
            <h3 class="text-success"><?= $product['price'] ?></h3>
            <?php if($product['stock'] > 0): ?>
            <a href="/orderJob.php?id=<?= $product['id'] ?>">
                <button class="btn btn-primary btn-lg mt-3">Buy now</button>
            </a>
            <?php else: ?>
                <strong>Product is out of stock.</strong>
            <?php endif; ?>
        </div>

        <div class="col-md-6 text-center">
            <img src="<?= $product['image'] ?>" class="img-fluid rounded shadow-lg" alt="<?= $product['name']; ?>">
        </div>
    </div>
</div>

<div class="container mt-lg-5 mb-lg-5">
    <h1 class="mt-lg-5 mb-lg-5">Newly added products</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($newest as $key => $product): ?>
            <div class="col">
                <div class="card <?= $key === 0 ? 'border-primary shadow-lg' : ''; ?>">
                    <img src="<?= $product['image_url'] ?>" class="card-img-top"
                         alt="<?= $product['name'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['name'] ?></h5>
                        <p class="card-text"><strong><?= $product['price'] ?></strong></p>
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
                    <img src="<?= $product['image_url'] ?>" class="card-img-top"
                         alt="<?= $product['name'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['name'] ?></h5>
                        <p class="card-text"><strong><?php echo $product['price'] ?></strong></p>
                        <a href="/product.php?id=<?= $product['id'] ?>" class="btn btn-primary">See more</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include './modules/footer.php'; ?>
</body>
</html>
