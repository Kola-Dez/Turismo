<?php
session_start();
    $current_page = $_SERVER['PHP_SELF'];
    if($current_page ==  '/views/content/content.php'){
        $current_page = '../../config/avtorization.php';
      }else{
        $current_page = 'config/avtorization.php';
      }
    require_once $current_page;
    $db = new avtorization();
    $select = $db->selectFun('places');
?>
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
p{
margin-bottom:  0;
}
h2{
margin-top: 0;
}
.head{
height: 60px;
}
.textcols{
margin: 10px;
width: 31%;
display: inline-block;
}
.textcols-item {	
border-radius: 20px; 
display: inline-block;
  width: 100%;
padding-left: 10px;
}
.imgs{
border-radius: 20px; 
width: 100%;
}
</style>
<?php foreach($select as $key){?>
    <div class="textcols">
	<div class="textcols-item">
    <img class="imgs" src="../../img/<?=$key['img']?>" width="200px" height="300px">
	</div>
	<div class="textcols-item">
    <h1><?=$key['name']?></h1>
    <p>Область:</p>
    <h2><?=$key['region']?></h2>
    <p>Цена:</p>
  <h2><?=$key['price']?></h2>
	</div>
</div>
<?}?>