<?php
    require_once "config/avtorization.php";
    $db = new avtorization();
    $select = $db->selectFun('places');
?>
<style>
    .slider {
        width: 100%;
        height: 100%;
        overflow: hidden;
        position: relative;
        background-color: #fff;
        margin-right: 100px;
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
            <?php foreach($select as $key) { ?>
                <div class="slide"><img src="img/<?= $key['img'] ?>" width="100%" height="100%"></div>
            <?php } ?>
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
