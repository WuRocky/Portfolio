<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IoT Watch | 你的健康管家</title>
    <!-- bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!--- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <!--Google font setting-->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
</head>
<bod <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>


    <!-- 上標籤 -->
    <header class="page-header">
        <div class="logo">

            <img src="./Logo/icons8-intelligent-person-64.png" alt="智能手錶首頁">
            <h1 class="logo-h1"><a href="./index.php">IoT Watch</a></h1>
        </div>
        <nav class="main-nav">
            <li class="signupbtn"><a href="./signup.php"><img src="./Icons/signup.png" /></a></li>
            <li class="loginbtn"><a href="./login.php"><img src="./Icons/login.png" /></a></li>
            <ul class="main-nav ul">
                <li><a href="member.php"><?php echo htmlspecialchars($_SESSION["username"]) ?></a></li>
                <li><a href="/php/logout.php">登出</a></li>
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

    <!-- 下面左邊內容 -->
    <!-- <article> -->
    <section class="backImage">


        <div class="article-home-content-wrapper01">
            <article>
                <p class="article-home-p">
                    智慧來自生活
                </p>

                <div class="article-page-title01">
                    <p class="article-home-p01">Welcome</p>
                </div>
        </div>
        <div class="article-home-content-wrapper">

            <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="2500">

                <div class="carousel-inner">
                    <div class="carousel-item">
                        <img src="https://www.don1don.com/wp-content/uploads/2019/02/Get-Faster_don1don-1.jpg" class="d-block w-100" alt="distance">
                    </div>
                    <div class="carousel-item active">
                        <img src="https://static.newmobilelife.com/wp-content/uploads/2014/12/HeartRate.jpeg" class="d-block w-100" alt="heart rate">
                    </div>
                    <div class="carousel-item">
                        <img src="https://ichef.bbci.co.uk/news/640/amz/worldservice/live/assets/images/2015/04/12/150412113259_joggingfeet640.gif" class="d-block w-100" alt="speed">
                    </div>
                </div>
            </div>
        </div>

    </section>
    <footer>
        <div class="footer-logo">
            <h1><img class="footer-loge-img" src="./Logo/icons8-intelligent-person-64.png" alt="Logo" />你的健康管家</h1>
        </div>

        <nav>
            <ul>
                <li><a href="#">首頁</a></li>
                <li><a href="./features.php">裝置介紹</a></li>
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