<?php
global $pdo;
session_start();
if (!isset($_SESSION['user']['status']) || !$_SESSION['user']['status']) {
    header('location: /admin/login.php');
    exit();
}

require_once '../../db.php';
require_once '../../functions/products.php';


if(isset($_POST['submit'])) {
    $res = updateProduct($pdo,$_GET['id'], $_POST['category'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['stock'], $_POST['mark']);
    if($res) {
        header('location: /admin/updateProduct.php?id=' . $_GET['id']);
    }
    else {
        header('location: /admin/updateProduct.php?id=' . $_GET['id'] . '&error=1');
    }
    exit();
}

header('location: /admin/products.php');
exit();

