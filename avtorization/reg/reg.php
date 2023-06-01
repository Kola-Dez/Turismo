<?php
session_start();
require_once '../../config/conect.php';

// Обработка отправленной формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $db = new Conect(); 
    $db->regFun('user', $name, $email, $password);
    // Закрытие сессии
    session_write_close();
    // Перенаправление пользователя
    header("Location: ../../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="reg.css">
  <title>Turismo</title>
</head>
<body>
    <div class="box">
        <span class="borderLine"></span>
        <form action="" method="post">
            <h2>Register</h2>
            <div class="inputBox">
                <input type="text" required="required" name="name">
                <span>Name</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="text" required="required" name="email">
                <span>E-mail</span>
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
