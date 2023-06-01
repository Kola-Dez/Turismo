<?php
    require_once "config/conect.php";
    $db = new Conect();
    $select = $db->selectFun('places', 'img');
?>
<style>
    .slider {
        width: 100%;
        height: 600px;
        overflow: hidden;
        position: relative;
        background-color: rgba(0, 0, 0, 0.299);
    }

    .slider .slides {
        display: flex;
        transition: transform 0.3s ease-in-out;
    }

    .slider .slide {
        flex: 0 0 100%;
        width: 100%;
    }
</style>

<body>
    <div class="slider">
        <div class="slides">
            <? foreach($select as $key){?>
            <div class="slide"><img src="img/<?=$key?>" width="100%" height="800px"></div>
            <?}?>
        </div>
    </div>    
</body>

<script>
    var slider = document.querySelector('.slider');
    var slides = document.querySelector('.slides');
    var slideWidth = slider.offsetWidth;
    var currentSlide = 0;

    function goToSlide(slideIndex) {
        slides.style.transform = `translateX(-${slideWidth * slideIndex}px)`;
        currentSlide = slideIndex;
    }

    setInterval(function() {
        currentSlide = (currentSlide + 1) % slides.children.length;
        goToSlide(currentSlide);
    }, 3000);
</script>