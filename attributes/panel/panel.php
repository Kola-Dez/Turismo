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
.panel {
display: flex;
margin: 50px 10px 10px 10px;
}

.panel .sidebar {
width: 200px;
background-color: #4255ff77;
padding: 20px;
border-radius: 40px;
margin-left: 10px;
}

.panel .content {
flex-grow: 1;
padding: 20px;
}

/* Стили для навигационного меню */
.sidebar .ul--1 {
list-style-type: none;
padding: 0;
margin: 0;
width: 200px;
}

.sidebar .li--1 {
margin-bottom: 10px;
width: 100%;
}

.sidebar .a--1 {
display: block;
text-align: center;
padding: 8px 16px;
background-color: #535e8e;
border-radius: 40px;
text-decoration: none;
color: #ffffff;
}

.sidebar .a--1:hover {
background-color: #bbb;
}
/* next */
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
<div class="panel">
    <div class="sidebar">
      <ul class="ul--1">
        <li class="li--1">
            <h1>Область</h1>
          <a class="a--1" href="?oblast=Иссык-Кульская">Иссык-Кульская</a>
        </li>
        <li class="li--1">
          <a class="a--1" href="?oblast=Чуйская">Чуйская</a>
        </li>
        <li class="li--1">
          <a class="a--1" href="?oblast=Таласская">Таласская</a>
        </li>
        <li class="li--1">
          <a class="a--1" href="?oblast=Нарынская">Нарынская</a>
        </li>
        <li class="li--1">
          <a class="a--1" href="?oblast=Ошская">Ошская</a>
        </li>
        <li class="li--1">
          <a class="a--1" href="?oblast=Джалал-Абадская">Джалал-Абадская</a>
        </li>
        <li class="li--1">
          <a class="a--1" href="?oblast=Баткенская">Баткенская</a>
        </li>
        <li class="li--1">
          <a class="a--1" href="/">Все</a>
        </li>
      </ul>
    </div>
    <div class="content">
        <tr>
            <td>   
                <div class="a--1">
                    <?php if(isset($_GET['oblast'])){?>                 
                            <?php foreach($select as $key){?>
                                <? if($_GET['oblast'] === $key['region']){ ?>
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
                    <? } } }else if(!isset($_GET['oblast'])){ ?>
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
                        <?} }?>
                </div>
            </td>
        </tr>
    </div>
  </div>