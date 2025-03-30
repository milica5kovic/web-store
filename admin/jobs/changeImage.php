<?php
global $pdo;
session_start();
if(!isset($_SESSION['user']['status']) || !$_SESSION['user']['status']){
    header('location: ../login.php');
    exit();
}

require_once '../../db.php';
require_once '../../functions/products.php';
require_once '../../dirmap.php';

if(isset($_GET['id'])) {
    $res = updateProductImage($pdo, $_GET['id']);
    if($res) {
        header('location: /admin/updateProduct.php?id='.$_GET['id']);
        exit();
    } else {
        header('location: /admin/updateProduct.php?id='.$_GET['id'].'&error=1');
        exit();
    }
}