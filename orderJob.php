<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('Location: catalogue.php');
    exit();
}

global $pdo;
require_once './db.php';
require_once './functions/products.php';

orderProduct($pdo, $id);

header('Location: ./product.php?id='.$id);
exit();