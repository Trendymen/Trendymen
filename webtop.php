<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trendymen首页</title>
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="stylesheet.css">
    <script src='nprogress.js'></script>
    <link rel='stylesheet' href='nprogress.css'/>
    <script src="js/jquery-1.8.3.min.js">
        window.onLoad =
            NProgress.start();
    </script>

    <style>
        .backgroungd {

            min-width: 1400px;
            height: 69px;
            width: 100%;
            background: linear-gradient(to right,#b9def0,pink);
            border-bottom: 2px solid gainsboro;
            box-shadow: 0 0 10px #ddd;
            -webkit-box-shadow: 0 0 10px #ddd;

        }

        .navbar {
            margin: 0 auto 0 auto;
            min-width: 1323px;
            width: 75%;
            background-color: rgba(0, 0, 0, 0);
            height: 69px;

        }

        .navbar ul {
            float: left;
            padding-left: 0px;
            margin-left: 100px;
            margin-top: 0px;

        }

        .navbar li {
            cursor: pointer;
            float: left;
            height: 69px;
            width: 75px;
            list-style: none;
            font-family: 微软雅黑, serif;
            font-weight: bold;
            text-align: center;
        }

        .navbar li + li {
            margin-left: 75px;
        }

        .navbar li a {
            line-height: 69px;
            font-size: 18px;
            text-decoration: none;
            color: #333333;
            transition-property: font-size, color; /*执行效果类*/
            transition-duration: 0.3s; /*执行效果时间*/
            transition-timing-function: ease-in-out; /*以相同的速度从开始到结束的过渡效果*/
        }

        .navbar li:hover a {
            color: #666666;
            font-size: 22px;
        }

        .logo {
            float: left;
            margin-left: 34px;
            margin-top: 6px;
        }

        .sousuo {
            float: left;
            margin-left: 70px;
            margin-top: 22px;
        }

        .shoppingcart {
            float: left;
            margin-top: 15px;
            margin-left: 0px;

        }

        .customservice {
            float: left;
            margin-top: 15px;
            margin-left: 21px;
        }

        .login {
            float: left;

            height: 69px;

        }

        .login a {
            transition-property: font-size, color; /*执行效果类*/
            transition-duration: 0.3s; /*执行效果时间*/
            transition-timing-function: ease-in-out; /*以相同的速度从开始到结束的过渡效果*/
            color: #333333;
            font-size: 16px;
            font-family: 微软雅黑, serif;
            font-weight: bold;
            display: inline;
            float: left;
            padding-top: 24px;
            padding-left: 21px;
        }

        .login a:hover {
            color: #666666;
            font-size: 22px;
        }

        .menu {

            cursor: pointer;
            width: 318px;
            height: 114px;
            font-size: 28px;
            font-weight: bold;
            font-family: 微软雅黑, serif;

        }
        .hr{
            height: 2px;
            background: linear-gradient(to right,white,grey,white);
            border-width: 1px;
            width: 318px;

        }
        .menu p {
            margin-top: 34px;
            float: left;
        }

        .menu img {
            transition-property: padding-left; /*执行效果类*/
            transition-duration: 0.2s; /*执行效果时间*/
            transition-timing-function: ease-in-out;
        }

        /*以相同的速度从开始到结束的过渡效果*/
        .menu:hover img {
            padding-left: 40px;
        }

        .content {
            padding: 20px 0 0 0;

        }

        #iPad li + li {
            margin-left: 200px;
        }

        #iPhone li + li {
            margin-left: 150px;
        }

        #iPhone {
            padding: 0 0 20px 0
        }

        #watch li + li {
            margin-left: 100px;
        }

        .content li + li {
            margin-left: 10px;

        }

        .content li {
            float: left;
            list-style: none;
            height: 200px;

        }

        .content a {
            color: #666666;
            font-family: 微软雅黑, serif;
            font-size: 13px;
            text-decoration: none;
            transition-property: color, font-size, font-weight; /*执行效果类*/
            transition-duration: 0.1s; /*执行效果时间*/
            transition-timing-function: ease; /*以相同的速度从开始到结束的过渡效果*/
        }

        .content a:hover {
            color: #24b6ee;
            font-weight: bold;
            font-size: 14px;
        }

        #bottom li + li {
            margin-left: 100px;
        }

        #bottom li {
            font-family: 微软雅黑, serif;
            font-size: 20px;
            font-weight: bold;
        }

        #easyui-searchbox {

            font-size: 14px;
            border-color: #919191;
            border-radius: 7px;
            border-width: 1px;
            border-style: solid;
            box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 8px;
            -moz-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 8px;
            -webkit-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 8px;
            line-height: 24px;
            height: 24px;
            padding: 1px;
            float: left;
            background-color: rgba(255, 255, 255, 0.6);
        }


        .title {

            font-size: 22px;
            padding-left: 5px;
            width: 1318px;
            height: 80px;
            margin: 0px auto 0px auto;
            line-height: 80px;
            border-radius: 15px;
            font-family: 微软雅黑, serif;
            font-weight: 600;
            color: #3b3b3b;
        }
        img{
            border: none;
        }
        .productspromote{
            background: linear-gradient(to bottom,white, #70d8ff,pink,white);
        }

    </style>
</head>
<!--导航栏-->
<body style="margin: 0;background-color: #ffffff">
<div class="backgroungd">
    <div class="navbar">
        <div class="logo">
            <a href="index.php"> <img  src="images/index/logo.png" height="56" width="131"/></a>
        </div>
        <ul>
            <li><a href="search_result.php?search=%E4%B8%8A%E8%A3%85">上装</a></li>
            <li><a href="search_result.php?search=%E4%B8%8B%E8%A3%85">下装</a></li>
            <li><a href="search_result.php?search=%E9%9E%8B%E5%93%81">鞋品</a></li>
            <li><a href="search_result.php?search=%E9%85%8D%E9%A5%B0">配饰</a></li>

        </ul>
        <!-- 搜索栏 -->
        <form action="search_result.php" method="get" class="sousuo" style="width:225px">
            <input id="easyui-searchbox" name="search" type="text"
                   value="<?php echo isset($_GET["search"]) ? $_GET["search"] : ''; ?>">
            <input type="image" src="images/index/search.png" height="18" width="17"
                   style="margin-left:5px;margin-top: 6px">

            </input>
        </form>

        <div class="shoppingcart">
            <a href="#"><img src="images/index/u14.png" height="40" width="40"/></a>
        </div>
        <div class="customservice">
            <a href="#"><img src="images/index/u12.svg" height="40" width="40"/></a>
        </div>
        <div class="login">
            <a href="
        <?php
            $href = isset($_COOKIE["username"]) ? "#" : "login.html";
            echo $href;
            ?>
        "
               style="text-decoration: none;">
                <?php
                $name = isset($_COOKIE["username"]) ? $_COOKIE["username"] : "登录";
                echo $name;
                ?></a>
        </div>

    </div>
</div>
<script>
    $('.version').text(NProgress.version);
    NProgress.start();
    setTimeout(function () {

        $('.fade').removeClass('out');
    }, 1);

    $(document).ready(function () {

        NProgress.done();
    });

    $("#b-0").click(function () {
        NProgress.start();
    });
    $("#b-40").click(function () {
        NProgress.set(0.4);
    });
    $("#b-inc").click(function () {
        NProgress.inc();
    });
    $("#b-100").click(function () {
        NProgress.done();
    });
</script>
</html>
