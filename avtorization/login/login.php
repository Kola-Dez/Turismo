<?php
session_start();
require_once '../../config/avtorization.php';

// Подключение к базе данныхs
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_unset();
    $name = $_POST['name'];
    $password = $_POST['password'];
    $db = new avtorization(); 
    $user = $db->logFun('users', $name, $password);
    if($user === 1){
        header('Location: ../admin/examination.php');
        exit;
    }else{
        echo "<h3 style='color: #fff;'>Не верный логин или пароль!</h3>   .";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="log.css">
  <link rel="icon" href="../../img/icon.ico" type="images/x-icon">
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
                <a href="../reg/reg.php">Register</a>
                <a href="/">Home</a>
            </div>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>