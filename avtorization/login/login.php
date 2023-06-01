<?php
session_start();
require_once '../../config/conect.php';

// Подключение к базе данных
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $db = new Conect(); 
    $db->logFun('user', $name, $password);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['name'];
    // header('Location: admin.php');
    // exit;
    // Закрытие сессии
    // Перенаправление пользователя
    header("Location: ../../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="log.css">
  <title>Turismo</title>
</head>
<body>
    <div class="box">
        <span class="borderLine"></span>
        <form action="" method="post">
            <h2>Sig in</h2>
            <div class="inputBox">
                <input type="text" required="required" name="name">
                <span>Name</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" required="required" name="password">
                <span>Password</span>
                <i></i>
            </div>
            <div class="links">
                <a href="#">Forgot Password</a>
                <a href="#">Register</a>
                <a href="#">Signup</a>
            </div>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>