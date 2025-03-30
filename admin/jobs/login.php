<?php

global $pdo;

if (isset($_POST['submit'])) {
    if (isset($_POST['pwd']) && isset($_POST['email'])) {
        include '../../db.php';
        session_start();

        $pwd = $_POST['pwd'];
        $email = $_POST['email'];
        $hashedPwd = hash('sha512', $pwd);

        $sql = "SELECT * FROM admin WHERE email = :email AND password = :password";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email, 'password' => $hashedPwd]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            unset($user['password']);
            $_SESSION['user'] = $user;
            $_SESSION['user']['status'] = true;

            header('Location: ../index.php?status=Logged in');
        } else {
            header('Location: ../login.php?error=Invalid email or password!');
        }
    } else {
        header('Location: ../login.php?error=Missing email or password!');
    }
    exit();
}

