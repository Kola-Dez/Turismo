<?php
  require_once "../../config/avtorization.php";
  session_start();
  // echo "<pre>";
  // print_r($_SERVER['QUERY_STRING']);
  // echo "</pre>";
  $id = $_SERVER['QUERY_STRING'];
  $db = new avtorization();
  $select = $db->selectOne('places', $id);
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
.content{
  justify-content: baseline;
  align-items: center;
  display: flex;
}
.Description{
  padding-left: 3%;
}


</style>
<body>
<div class="user"><?php if(isset($_SESSION['name'])){ require_once '../../attributes/user/user.php';} ?></div>
<div class="head"><?php require_once '../../attributes/head/head.php';?></div>

<div class="content">
  <img id="cont" src="../../img/<?= $select['img'] ?>" width="40%">
  <div class="Description">
    <b style="font-size: 2em;" id="cont"><?= $select['name'] ?></b>
    <p id="cont">Регион: <?= $select['region'] ?></p>
    <br>
    <p><?= $select['content']?></p>
    <p id="cont">Цена: <?= $select['price'] ?></p>
  </div>
</div>


<div class="contentBlock"><?php require_once '../../attributes/panel/panel.php'?></div>

<div class="footer"><?php require_once '../../attributes/footer/footer.php';?></div>
</body>
</html>