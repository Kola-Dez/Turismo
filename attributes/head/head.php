<?php session_start();
$current_page = $_SERVER['PHP_SELF'];
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap');
    body{
        font-family: 'Poppins', sans-serif;
    }
    *{
        margin: 0;
        padding: 0;
    }
    head{
        width: 100%;
        margin: 0;
        font-family: Tahoma,sans-serif;
    }
    head:before{
        content: "";
        display: block;
        height: 100px;
        position: absolute;
        left: 0;
    }
    .ul-1{
        margin: 0;
        padding: 0;
        list-style: none; /* убрать точки */
    }
    .ul-1 .li-1{
        float: right;
    }
    .ul-1 .li-1 .a-1{
        display: block;
        padding: 0 40px;
        text-transform: uppercase;
        text-decoration: none;
        line-height: 50px;
    }
    .ul-1 .li-1 .a-1:hover{
        background: #d34d43;
        color:white;
    }
    @keyframes AAA{
        0%{
            transform: rotate(0deg);
        }
        50%{
            transform: rotate(-10deg);
        }
        100%{
            transform: rotate(-5deg);
        }
    }
    .img-1{
        position: relative;
        animation-name:AAA ;
        float: left;
        animation-duration: 3s;
        animation-iteration-count:infinite;
        animation-direction: alternate ;
        animation-delay: 1s;
}
/* @media (max-width: 940px){
    .ul-1 .li-1 .a-1{
    }
} */
</style>

    <head>
        <ul class="ul-1">
        <a href="/"><img src="<?if($current_page === '/avtorization/admin/admin.php'){echo '../../img/Logoa.png';}else{echo '../../img/Logo1.png';} ?>" width="130px" class="img-1"></a>
            <li class="li-1"><a class="a-1" href="/avtorization/login/login.php">LOGIN</a></li>
            <li class="li-1"><a class="a-1" href="/avtorization/reg/reg.php">REGISTER</a></li>
            <li class="li-1"><a class="a-1" href="/views/contact/contact.php">CONTACT</a></li>
            <li class="li-1"><a class="a-1" href="/views/content/content.php">CONTENT</a></li>
        </ul>
    </head>