<? session_start();?>
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
    }
</style>

<body>
    <head>
        <ul class="ul-3">
            <li class="li-3"><a class="a-3" href="<?php if($_SESSION['name'] === 'admin'){echo '/avtorization/admin/admin.php';}else{echo 'views/user/user.php';} ?>"><?=$_SESSION['name']?></a></li>
        </ul>
    </head>
</body>