<?php
global $pdo;
session_start();
if (!isset($_SESSION['user']['status']) || !$_SESSION['user']['status']) {
    header('location: /admin/login.php');
    exit();
}
require_once '../../db.php';
require_once '../../functions/products.php';
require_once '../../dirmap.php';

if (isset($_POST['submit'])) {
    addProduct($pdo, $_SESSION['user']['id'], $_POST['category'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['stock']);
}
header('location: /admin/products.php');
exit();