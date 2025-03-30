<?php
global $pdo;
session_start();
if(!isset($_SESSION['user']['status']) || !$_SESSION['user']['status']){
    header('location: /admin/login.php');
    exit();
}




require_once '../../db.php';
require_once '../../functions/categories.php';

if(isset($_POST['submit'])){
    $res = createCategory($pdo, $_POST['name'], $_SESSION['user']['id']);
    if($res){
        header('location: /admin/categories.php');
    } else {
        header('location: /admin/categories.php?error=1');
    }
    exit();
}

header('location: /admin/categories.php');
exit();
