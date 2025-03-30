<?php

global $pdo;
session_start();
if (!isset($_SESSION['user']['status']) || !$_SESSION['user']['status']) {
    header('location: ../login.php');
    exit();
}

require_once '../../db.php';
require_once '../../functions/categories.php';

if (isset($_GET['id'])) {
    $res = updateCategory($pdo, $_GET['id'], $_GET['name']);
    if ($res) {
        header('location: ../categories.php');
        exit();
    }
    header('location: ../categories.php?error=1');
    exit();
}

header('location: ../categories.php');
exit();