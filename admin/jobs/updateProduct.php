<?php
global $pdo;
session_start();
if (!isset($_SESSION['user']['status']) || !$_SESSION['user']['status']) {
    header('location: ../login.php');
    exit();
}

require_once '../../db.php';
require_once '../../functions/products.php';


if(isset($_POST['submit'])) {
    $res = updateProduct($pdo,$_GET['id'], $_POST['category'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['stock'], $_POST['mark']);
    if($res) {
        header('location: ../updateProduct.php?id=' . $_GET['id']);
    }
    else {
        header('location: ../updateProduct.php?id=' . $_GET['id'] . '&error=1');
    }
    exit();
}

header('location: ../products.php');
exit();

