<?php
global $pdo;
session_start();
if(!isset($_SESSION['user']['status']) || !$_SESSION['user']['status']){
    header('location: ../login.php');
    exit();
}

require_once '../../db.php';
require_once '../../functions/categories.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    deleteCategory($pdo, $id);
    header('location: /admin/categories.php?success=true');
    exit();
}

header('location: /admin/categories.php?success=false');
exit();