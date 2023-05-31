<style>
    body{
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
        color: black;
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
        position: absolute;
        animation-name:AAA ;
        animation-duration: 3s;
        animation-iteration-count:infinite;
        animation-direction: alternate ;
        animation-delay: 1s;
}
</style>

<body>
    <head>
        <ul class="ul-1">
        <img src="../../img/Logo1.png" width="130px" class="img-1">
            <li class="li-1"><a class="a-1" href="#">LOGIN</a></li>
            <li class="li-1"><a class="a-1" href="#">REGISTER</a></li>
            <li class="li-1"><a class="a-1" href="#">HOME</a></li>
            <li class="li-1"><a class="a-1" href="#">CONTENT</a></li>
            <li class="li-1"><a class="a-1" href="views/about/about.php">ABOUT US</a></li>
        </ul>
    </head>
</body>