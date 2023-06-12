<?php
session_start();
?>
<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Turismo</title>
  <link rel="icon" href="../../img/icon.ico" type="images/x-icon">
  <link rel="stylesheet" href="content.css">
</head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap');
body{
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
}
</style>
<body>
<div class="user"><?php require_once '../../attributes/user/user.php'; ?></div>
<div class="head"><?php require_once '../../attributes/head/head.php';?></div>

<div class="contentBlock"><?php require_once '../../attributes/panel/panel.php'?></div>

<div class="footer"><?php require_once '../../attributes/footer/footer.php';?></div>
</body>
</html>