<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
} ?>

<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
    <title>登入</title>

    <!-- bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!--- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <!--Google font setting-->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <!-- 上標籤 -->
    <header class="page-header">
        <div class="logo">

            <a href="#">
                <img src="./Logo/icons8-intelligent-person-64.png" alt="智能手錶首頁">
            </a>
            <h1 class="logo-h1"><a href="./index.php">IoT Watch</a></h1>
        </div>
        <nav class="main-nav">
            <ul class="main-nav ul">
                <li><a href="member.php"><?php echo htmlspecialchars($_SESSION["username"]) ?></a></li>
                <li><a href="index.php">首頁</a></li>

                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">裝置介紹</a>
                    <div class="dropdown-content">
                        <a href="devices.php">裝備使用</a>
                        <a href="features.php">功能介紹</a>
                        <a href="members.php">成員介紹</a>
                    </div>
                </li>

                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">測量圖</a>
                    <div class="dropdown-content">
                        <a href="./heart.php">心跳圖</a>
                        <a href="#">速度</a>
                        <a href="#">距離</a>
                    </div>
                </li>
                <li><a href="#">影片介紹</a></li>
            </ul>
        </nav>
    </header>
    <!-- <main class="new-contents"></main> -->
    <!--image part of the first page-->
    <!-- 下面右邊內容 -->
    <div class="aside">
        <section class="form">
            <form action="/php/login_regis.php" method="POST">
                <!-- onsubmit='return check()' -->
                <div>
                    <label for="username">帳號：</label>
                    <input type="text" placeholder="請輸入帳號" name="username" id="username" required />
                </div>
                <div>
                    <label for="password">密碼：</label>
                    <input type="password" placeholder="請輸入密碼" name="password" id="password" required />
                </div>
                <br />
                <div><span><?php ?></span></div>
                <button type="submit">登入</button>
            </form>
            <script type="text/javascript">
                function check() {
                    var username = document.getElementById("username").value;
                    if (!/^[a-zA-Z0-9_]+$/.test(username)) {
                        alert('帳號含不合法字元');
                        return false;
                    }
                    var password = document.getAnimations("password").value;
                    if (/[\s\n\t\r]*$/.test(password)) {
                        alert('密碼不能為空');
                        return false;
                    }
            </script>
        </section>

    </div>
    <div class="side">
        <ul class="side-item">
            <li><a href="devices.php">使用裝備</a></li>
            <li><a href="features.php">功能介紹</a></li>
            <li><a href="members.php">成員介紹</a></li>
        </ul>
    </div>
    </section>
    <footer>
        <div class="footer-logo">
            <h1><img class="footer-loge-img" src="./Logo/icons8-intelligent-person-64.png" alt="Logo" />你的健康管家</h1>
        </div>

        <nav>
            <ul>
                <li><a href="#">首頁</a></li>
                <li><a href="#">裝置介紹</a></li>
                <li><a href="#">測量圖</a></li>
                <li><a href="#">影片介紹</a></li>
            </ul>
        </nav>
        <section>
            <a class="section-img" href="#"><img src="./Icons/facebook-svgrepo-com.svg" alt="facebook" /></a>
            <a class="section-img" href="#"><img src="./Icons/instagram-svgrepo-com.svg" alt="instagram" /></a>
            <a class="section-img" href="#"><img src="./Icons/youtube.svg" alt="youtube" /></a>
        </section>
        <div>
            <span><a href="#">關於我們</a>&nbsp; |&nbsp; <a href="#">聯絡我們</a>&nbsp; | &nbsp;<a href="#">常見問答</a></span>
            <span>&nbsp; &nbsp; &copy;IoT Watch版權所有</span>
        </div>
    </footer>
</body>

</html>