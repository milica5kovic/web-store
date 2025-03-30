<?php
global $pdo;
require_once './db.php';
require_once './functions/products.php';
require_once './dirmap.php';
require_once './functions/categories.php';
$marked = fetchMarkedProducts($pdo);
$categories = fetchCategories($pdo);
$newest = newestProducts($pdo);
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

</head>

<body>

<div class="hero_area">

    <div class="hero_bg_box">
        <div class="bg_img_box">
            <img src="images/hero-bg.png" alt="">
        </div>
    </div>

    <header class="header_section">
        <div class="container-fluid">
            <?php include './modules/header.php'; ?>
        </div>
    </header>
    <section class="slider_section ">
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($marked as $key => $product): ?>
                    <div class="carousel-item <?php echo $key === 0 ? 'active' : ''; ?>">
                        <div class="container ">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="detail-box">
                                        <h1>
                                            <?= $product['name'] ?>
                                        </h1>
                                        <p>
                                            <?= substr($product['description'], 0, 200) ?>...
                                        </p>
                                        <div class="btn-box">
                                            <a href="./product.php?id=<?= $product['id'] ?>" class="btn1">
                                                Read More
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="img-box">
                                        <img src="<?= $product['image_url'] ?>" alt="Product image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <ol class="carousel-indicators">
                <?php foreach ($marked as $key => $product): ?>
                    <li data-target="#customCarousel1" data-slide-to="<?= $key ?>>"
                        class="<?php echo $key === 0 ? 'active' : ''; ?>"></li>
                <?php endforeach; ?>
            </ol>
        </div>

    </section>

</div>
<div class="container mt-lg-5 mb-lg-5">
    <h1 class="mt-lg-5 mb-lg-5">Newly added products</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($newest as $key => $product): ?>
            <div class="col">
                <div class="card <?php echo $key === 0 ? 'border-primary shadow-lg' : ''; ?>">
                    <img src="<?php echo $product['image_url']; ?>" class="card-img-top"
                         alt="<?php echo $product['name']; ?>">
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
<?php include './modules/footer.php'; ?>
</body>

</html>