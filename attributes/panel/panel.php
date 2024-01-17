<?php
    session_start();
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

.sidebar .button-panel {
margin-bottom: 10px;
width: 100%;
}

.sidebar .cont-panel {
display: block;
text-align: center;
padding: 8px 16px;
background-color: #535e8e;
border-radius: 40px;
text-decoration: none;
color: #ffffff;
}

.sidebar .cont-panel:hover {
background-color: #bbb;
}
/* next */
p{
margin-bottom:  0;
}
.h1s{
  text-align: center;
}
h2{
margin-top: 0;
}
.head{
height: 60px;
}
.textcols{
margin: 10px;
width: 380px;
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
.button-panel {
  padding: 10px 20px; /* Увеличили внутренний отступ для более крупной кнопки */
  border-radius: 10px;
  border: none; /* Убрали границу для более современного вида */
  text-align: center;
  background-color: aquamarine;
  transition: background-color 0.3s, transform 0.2s; /* Добавили анимацию цвета и трансформации */
  cursor: pointer;
  font-size: 16px;
  color: #333; /* Цвет текста кнопки */
}

.button-panel:hover {
  background-color: antiquewhite; /* Новый фоновый цвет при наведении */
  transform: scale(1.1); /* Масштабируем кнопку для эффекта нажатия */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Тень при наведении */
}


</style>
<div class="panel">
  <div class="sidebar">
    <ul class="ul--1">
      <h1 class="h1s">Область</h1>
      <button class="button-panel" id="issykkul">Иссык-Кульская</button>
      <button class="button-panel" id="chuyskaya">Чуйская</button>
      <button class="button-panel" id="talasskaya">Таласская</button>
      <button class="button-panel" id="narynskaya">Нарынская</button>
      <button class="button-panel" id="oshskaya">Ошская</button>
      <button class="button-panel" id="jalalabadskaya">Джалал-Абадская</button>
      <button class="button-panel" id="batkenskaya">Баткенская</button>
      <button class="button-panel" id="all">Все</button>
    </ul>
  </div>
<div class="content">
    <tr>
        <td>
            <div class="cont-panel">
                    <?php foreach($select as $key){?>
                      <a style="color: inherit;" href="/views/content/content.php?<?= $key['id']?>">
                              <div class="textcols"  id="<?= $key['region']?>">
                                <div class="textcols-item">
                                  <img class="imgs" src="../../img/<?=$key['img']?>" width="200px" height="250px">
                                </div>
                              <div class="textcols-item">
                                  <h1><?=$key['name']?></h1>
                                <p>Регион:</p>
                                  <h2><?=$key['region']?></h2>
                                <p>Цена:</p>
                                  <h2><?=$key['price']?></h2>
                              </div>
                          </div>
                          </a>
                    <?}?>
            </div>
        </td>
    </tr>
</div>
<script>
const issykkulButton = document.getElementById('issykkul');
const chuyskayaButton = document.getElementById('chuyskaya');
const talasskayaButton = document.getElementById('talasskaya');
const narynskayaButton = document.getElementById('narynskaya');
const oshskayaButton = document.getElementById('oshskaya');
const jalalabadskayaButton = document.getElementById('jalalabadskaya');
const batkenskayaButton = document.getElementById('batkenskaya');
const allButton = document.getElementById('all');

function hideElements(regionId) {
  const elements = document.querySelectorAll('.textcols');//Здесь мы выбираем все элементы на странице с классом textcols с помощью 
  elements.forEach((element) => {//Затем мы используем метод forEach, чтобы перебрать все выбранные элементы в коллекции elements.
    if (element.id === regionId || regionId === 'all') {
      element.style.display = 'inline-block';
    } else {
      element.style.display = 'none';
    }
  });
}

issykkulButton.addEventListener('click', function() {
  hideElements('Иссык-Кульская');
});

chuyskayaButton.addEventListener('click', function() {
  hideElements('Чуйская');
});

talasskayaButton.addEventListener('click', function() {
  hideElements('Таласская');
});

narynskayaButton.addEventListener('click', function() {
  hideElements('Нарынская');
});

oshskayaButton.addEventListener('click', function() {
  hideElements('Ошская');
});

jalalabadskayaButton.addEventListener('click', function() {
  hideElements('Джалал-Абадская');
});

batkenskayaButton.addEventListener('click', function() {
  hideElements('Баткенская');
});

allButton.addEventListener('click', function() {
  hideElements('all');
});

    </script>
  </div>