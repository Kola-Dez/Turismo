<? session_start();
    if(empty($_SESSION['img'])){
        $_SESSION['img'] = 'Defolt.png';
    }
    if(isset($_GET["clear"])){
        session_unset();
        header('Location: /');
    }
?>
<style>
    body{
        margin: 0;
        padding: 0;
    }
    .ul-3{
        margin: 0;
        padding: 0;
        list-style: none; /* убрать точки */
    }
    .ul-3 .li-3{
        float: right;
    }
    .ul-3 .li-3 .a-3{
        color: black;
        background-color: #b0ceff;
        border-radius: 50px;
        display: block;
        padding: 0 60px;
        text-transform: uppercase;
        text-decoration: none;
        line-height: 50px;
        margin-top: 2px;
    }
    .img--1{
        margin:0 0 0 5px;
        border-radius: 50px;
    }
    .ul-3 .li-3 .a-3:hover{
        background-color: coral;
        color: #fff;
    }

</style>

<body>
    <head>
        <ul class="ul-3">
            <li class="li-3">
                <div class="img--1">
                    <img class="img--1" src="imgDefolt/imgUsers/<?=$_SESSION['img']?>" width="50px" height="50px">
                </div>
            </li>
            <li class="li-3">
                <div class="us">
                    <a class="a-3" href="<?php if($_SESSION['name'] === 'admin'){
                        echo '/avtorization/admin/admin.php';
                    }else{
                        echo '/views/user/user.php';
                    } ?>">
                            <?=$_SESSION['name']?>
                    </a>
                </div>
            </li>
            <li class="li-3"><a class="a-3" href="?clear=1">LOG OUT</a></li>
        </ul>
    </head>
</body>