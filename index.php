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
  <link rel="stylesheet" href="style/style.css">
  <link rel="icon" href="imgDefolt/DefoltFoto/icon.ico" type="images/x-icon">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplebar/5.3.6/simplebar.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/simplebar/5.3.6/simplebar.min.js"></script>


  <title>Turismo</title>
</head>
<body>


  <div class="user">
    <?php if(isset($_SESSION['name'])){ require_once 'attributes/user/user.php';} ?>
  </div>

  <div class="head">
    <?php require_once 'attributes/head/head.php'; ?>
  </div>

  <div class="content">
    <?php require_once 'attributes/content/content.php'; ?>
  </div>

  <div class="content2">
    <?php require_once 'attributes/panel/panel.php'; ?>
  </div>

  <div class="footer">
    <?php require_once 'attributes/footer/footer.php'; ?>
  </div>

  <script src="js/jquery-3.7.1.min.js"></script>
  <script src="js/script.js"></script>
</body>
</html>
