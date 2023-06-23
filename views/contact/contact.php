<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="icon" href="../../img/icon.ico" type="images/x-icon">
  <title>Turismo</title>
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap');
html{
margin: 0;
padding: 0; 
}
body{
margin: 0;
padding: 0;
font-family: 'Poppins', sans-serif;
}
.head{
  height: 60px;
}

</style>
<body>
<div class="user"><?php if(isset($_SESSION['name'])){ require_once '../../attributes/user/user.php';} ?></div>
<div class="head"><?php require_once '../../attributes/head/head.php';?></div>

    <div class="content"><b>ADMIN - </b><a href="mailto:kola.stalker.04@gmail.com">kola.stalker.04@gmail.com</a></div>

<div class="footer"><?php require_once '../../attributes/footer/footer.php';?></div>
</body>
</html>