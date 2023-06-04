<?php
  session_start();
  if (empty($_SESSION['name'])) {
    $_SESSION['name'] = null;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style/lol.css">
  <link rel="icon" href="img/icon.ico" type="images/x-icon">
  <title>Turismo</title>
</head>
<body>
  <div class="user">
    <?php require_once 'attributes/user/user.php'; ?>
  </div>

  <div class="head">
    <?php require_once 'attributes/head/head.php'; ?>
  </div>

  <div class="content">
    <?php require_once 'attributes/content/content.php'; ?>
  </div>

  <div class="content">
    <?php require_once 'attributes/panel/panel.php'; ?>
  </div>

  <div class="footer">
    <?php require_once 'attributes/footer/footer.php'; ?>
  </div>
</body>
</html>
