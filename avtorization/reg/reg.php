<?php
session_start();
require_once '../../config/avtorization.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $img = 'Defolt.png';
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $password = $_POST['password'];
        $db = new avtorization(); 
        $dat = $db->regFun('users', $name, $email, $password, $img);

        if("1" ===  $dat){
            echo "<h3 style='color: #fff;'>E-mail занят!</h3>     .";
        }
        if("2" ===  $dat){
            echo "<h3 style='color: #fff;'>Имя занято!</h3>     .";
        }
        if(3 ===  $dat){
            $db->IdCheckFun('users', $name);
            header("Location: /");
            die();
        }
        session_unset();
    }else {
        echo "<h3 style='color: #fff;'>Email-адрес не корректный</h3>     .";
    }
}

// Обработка отправленной формы

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="reg.css">
  <link rel="icon" href="../../img/icon.ico" type="images/x-icon">
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
                <a href="../login/login.php">Login</a>
                <a href="/">Home</a>
            </div>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
