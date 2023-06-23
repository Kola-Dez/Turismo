<?php
  session_start();
  if(empty($_SESSION['name'])){
    $_SESSION['name'] = Null;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style/style.css">
  <link rel="icon" href="../../img/icon.ico" type="images/x-icon">
  <link rel="stylesheet" href="style.css">
  <title>Turismo</title>
</head>
<body>
    <div class="user"><?php require_once '../../attributes/user/user.php'; ?></div>

    <div class="head"><?php require_once '../../attributes/head/head.php';?></div>

    <div class="contentUser"><?php require_once '../../attributes/contentUser/contentUser.php';?></div>

    <div class="footer"><?php require_once '../../attributes/footer/footer.php';?></div>
</body>
</html>