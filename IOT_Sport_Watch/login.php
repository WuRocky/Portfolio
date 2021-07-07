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
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- 上標籤 -->
    <header class="page-header wrapper">
        <div class="container">
            <div class="logo">

                <a href="./index.php">
                    <img src="./logo/icons8-intelligent-person-64.png" alt="智能手錶首頁">
                </a>
                <h1 class="logo-h1">IoT&nbsp;Watch</h1>
                <li class="signupbtn"><?php if (!isset($_SESSION['username'])) : ?><a href="./signup.php"><img src="./Icons/signup.png" /><?php endif ?></li>
                <li class="loginbtn"><?php if (!isset($_SESSION['username'])) : ?><a href="./login.php"><img src="./Icons/login.png" /><?php endif ?></li>
            </div>
        </div>
        <div class="container">

            <nav class="main-nav">
                <li><a href="index.php">首頁</a></li>

                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">裝置介紹</a>
                    <div class="dropdown-content">
                        <a href="devices.php">裝備使用</a>
                        <a href="features.php">功能介紹</a>
                        <a href="members.php">成員介紹</a>
                    </div>
                </li>

                <li><a href="Datacharts.php">測量圖</a></li>

                <li><a href="video.php">影片介紹</a></li>
            </nav>

        </div>

    </header>
    <!-- <main class="new-contents"></main> -->
    <!--image part of the first page-->
    <!-- 下面右邊內容 -->
    <div class="aside">
        <section class="form">
            <form id="login-form">
                <!-- onsubmit='return check()' -->
                <div class="row">
                    <div id="message" class="message"></div>
                </div>
                <div>
                    <label for="username">帳號：</label>
                    <input type="text" placeholder="請輸入帳號" name="username" id="username" required />
                </div>
                <br />
                <div>
                    <label for="password">密碼：</label>
                    <input type="password" placeholder="請輸入密碼" name="password" id="password" required />
                </div>
                <br />
                <div style="display:inline-block">
                    <button type="button" id="but_submit" name="but_submit">登入</button>
                </div>
            </form>
        </section>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#but_submit").click(function() {
                    var username = $("#username").val().trim();
                    var password = $("#password").val().trim();

                    if (username != "" && password != "") {
                        $.ajax({
                            url: './php/login_regis.php',
                            type: 'post',
                            data: {
                                username: username,
                                password: password
                            },
                            success: function(response) {
                                var msg = "";
                                switch (response) {
                                    case 'success':
                                        window.location = "./index.php";
                                        break;
                                    case 'password_error':
                                        msg = "密碼輸入錯誤";
                                        break;
                                    case 'account_error':
                                        msg = "查無此帳號";
                                        break;
                                    case 'NULL':
                                        msg = "帳號或密碼輸入空值";
                                        break;
                                }
                                $("#message").html(msg);
                            }
                        });
                    }
                });
            });
        </script>


    </div>
    <div class="side">
        <ul class="side-item">
            <li><a href="devices.php">使用裝備</a></li>
            <li><a href="features.php">功能介紹</a></li>
            <li><a href="members.php">成員介紹</a></li>
        </ul>
    </div>
    </section>

    <footer class="footer-wrapper">
        <div class="footer-logo">
            <h1><img class="footer-loge-img" src="./logo/icons8-intelligent-person-64.png" alt="Logo" />你的健康管家</h1>
        </div>

        <nav>
            <ul>
                <li><a href="./index.php">首頁</a></li>
                <li><a href="./features.php">裝置介紹</a></li>
                <li><a href="./Datacharts.php">測量圖</a></li>
                <li><a href="./video.php">影片介紹</a></li>
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