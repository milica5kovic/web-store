<?php
global $pdo;
session_start();
if(!isset($_SESSION['user']['status']) || !$_SESSION['user']['status']){
    header('location: /admin/login.php');
    exit();
}


require_once '../../db.php';
require_once '../../functions/products.php';

if(isset($_GET['id'])){
    $res = deleteProduct($pdo, $_GET['id']);
    if($res){
        header('location: /admin/products.php');
        exit();
    }

    header('location: /admin/products.php?error=1');
    exit();
}

header('location: /admin/products.php');
exit();