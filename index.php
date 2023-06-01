<?php
  session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style/lol.css">
  <link rel="icon" href="img/.ico" type="images/x-icon">
  <title>Turismo</title>
</head>
<body>
    <div class  ="head"><?php require_once 'attributes/head/head.php';?></div>

    <div class="content"><?php require_once 'attributes/content/content.php';?></div>

    <?php var_dump($_SESSION); $_COOKIE['PHPSESSID'] = ''; ?>

    <div class="footer"><?php require_once 'attributes/footer/footer.php';?></div>
</body>
</html>