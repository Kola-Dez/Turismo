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
    }

    .slider .slides {
        display: flex;
        transition: transform 1s ease-in-out;
    }

    .slider .slide {
        flex: 0 0 100%;
        width: 100%;
        position: relative;
    }

    .slide .img-content {
        width: 100%;
        height: 800px;
    }

    .text-content {
        padding-bottom: 2%;
        position: absolute;
        z-index: 2;
        color: #fff;
        background: rgba(0, 0, 0, 0.5);
        width: 100%;
        bottom: 0;
    }
    /* Стили для стрелочек */
#prev-button,
#next-button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 0px;
    height: 0px;
    color: white;
    font-size: 24px;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    z-index: 3;
}

#prev-button {
    left: 15px; /* Вы можете настроить положение стрелочек по своему усмотрению */
}

#next-button {
    right: 30px; /* Вы можете настроить положение стрелочек по своему усмотрению */
}

</style>

<body>
<div class="slider">
    <button id="prev-button">◄</button>
    <div class="slides">
            <?php foreach($select as $key) { ?>
                <a class="slide" href="/views/content/content.php?<?= $key['id']?>">

                        <img class="img-content" src="img/<?= $key['img'] ?>" width="100% auto" height="800hv">
                        <div class="text-content">
                            <b style="padding-left:10px;font-size: 100px;"><?= $key['name'] ?></b>
                            <br>
                            <p style="padding-left:10px;font-size: 50px;">Регион: <?= $key['region'] ?></p>
                            <br>
                            <p style="padding-left:10px;font-size: 40px">Цена: <?= $key['price'] ?></p>
                        </div>
                </a>
            <?php } ?>
            </div>
    <button id="next-button">►</button>
</div>   
</body>

<script>
    var slider = document.querySelector('.slider');
    var slides = document.querySelector('.slides');
    var slideWidth = slider.offsetWidth;
    var currentSlide = 0;
    const prevButton = document.getElementById('prev-button');
const nextButton = document.getElementById('next-button');

function goToSlide(slideIndex) {
    slides.style.transform = `translateX(-${slideWidth * slideIndex}px)`;
    currentSlide = slideIndex;
}

prevButton.addEventListener('click', function() {
    currentSlide = (currentSlide - 1 + slides.children.length) % slides.children.length;
    goToSlide(currentSlide);
});

nextButton.addEventListener('click', function() {
    currentSlide = (currentSlide + 1) % slides.children.length;
    goToSlide(currentSlide);
});

    setInterval(function() {
        currentSlide = (currentSlide + 1) % slides.children.length;
        goToSlide(currentSlide);
    }, 3000);
</script>
