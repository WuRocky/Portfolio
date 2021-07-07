<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
    <title>IoT Watch | 你的健康管家</title>


    <!-- bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!--- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <!--Google font setting-->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet" />
    <link href="./css/style.css" rel="stylesheet">

</head>

<body>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
        crossorigin="anonymous"></script>

    <!-- 上標籤 -->
    <header class="page-header wrapper">
        <div class="container">
            <div class="logo">

                <a href="./index.php">
                    <img src="./logo/icons8-intelligent-person-64.png" alt="智能手錶首頁">
                </a>
                <h1 class="logo-h1">IoT&nbsp;Watch</h1>
                <li class="signupbtn"><?php  if (!isset($_SESSION['username'])) : ?><a href="./signup.php"><img src="./Icons/signup.png" /><?php endif ?></li>
                <li class="loginbtn"><?php  if (!isset($_SESSION['username'])) : ?><a href="./login.php"><img src="./Icons/login.png" /><?php endif ?></li>

            </div>
        </div>
        <div class="container">

            <nav class="main-nav">
                <li><a href="./member.php"><?php echo htmlspecialchars($_SESSION["username"]) ?></a></li>
                <li><?php  if (isset($_SESSION['username'])) : ?><a href="./php/logout.php">登出</a></a><?php endif ?></li>
                <li><a href="./index.php">首頁</a></li>


                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">裝置介紹</a>
                    <div class="dropdown-content">
                        <a href="./devices.php">裝備使用</a>
                        <a href="./features.php">功能介紹</a>
                        <a href="./members.php">成員介紹</a>
                    </div>
                </li>

                <li><a href="./Datacharts.php">測量圖</a></li>

                <li><a href="./video.php">影片介紹</a></li>
            </nav>

        </div>

    </header>
    <!-- 下面右邊內容 -->
    <section>

        <div class="aside">
            <div class="aside-itme">
                <img src="members/梁柏堅.jpg" class="aside-itme-img" alt="梁柏堅">
                <div class="aside-itme-dropdown-content">
                    <p>組長Server</p>
                    <p class="aside-itme-img-p">梁柏堅</p>
                </div>
            </div>
            <div class="aside-itme">
                <img src="members/余秉祐.jpg" class="aside-itme-img" alt="余秉祐">
                <div class="aside-itme-dropdown-content">
                    <p>Back End</p>
                    <p class="aside-itme-img-p">余秉祐</p>
                </div>
            </div>
            <div class="aside-itme">
                <img src="members/楊孟勳.jpg" class="aside-itme-img" alt="楊孟勳">
                <div class="aside-itme-dropdown-content">
                    <p>Sensor</p>
                    <p class="aside-itme-img-p">楊孟勳</p>
                </div>
            </div>
            <div class="aside-itme">
                <img src="members/黃子益.jpg" class="aside-itme-img" alt="黃子益">
                <div class="aside-itme-dropdown-content">
                    <p>Server</p>
                    <p class="aside-itme-img-p">黃子益</p>
                </div>
            </div>
            <div class="aside-itme">
                <img src="members/吳俊寬.jpg" class="aside-itme-img" alt="吳俊寬">
                <div class="aside-itme-dropdown-content">
                    <p>Front End</p>
                    <p class="aside-itme-img-p">吳俊寬</p>
                </div>
            </div>
            <div class="aside-itme">
                <img src="members/張庭愷.jpg" class="aside-itme-img" alt="張庭愷">
                <div class="aside-itme-dropdown-content">
                    <p>Back End</p>
                    <p class="aside-itme-img-p">張庭愷</p>
                </div>
            </div>
            <div class="aside-itme">
                <img src="members/廖嘉盈.jpg" class="aside-itme-img" alt="廖嘉盈">
                <div class="aside-itme-dropdown-content">
                    <p>Front End</p>
                    <p class="aside-itme-img-p">廖嘉盈</p>
                </div>
            </div>
            <div class="aside-itme">
                <img src="members/高秀慧.jpg" class="aside-itme-img" alt="高秀慧">
                <div class="aside-itme-dropdown-content">
                    <p>Front End</p>
                    <p class="aside-itme-img-p">高秀慧</p>
                </div>
            </div>
            <div class="aside-itme">
                <img src="members/吳俊妤.jpg" class="aside-itme-img" alt="吳俊妤">
                <div class="aside-itme-dropdown-content">
                    <p>文獻收集</p>
                    <p class="aside-itme-img-p">吳俊妤</p>
                </div>
            </div>
        </div>



        <!-- 左側內容 -->
        <div class="side">
            <ul class="side-item">
                <li><a href="./devices.php">使用裝備</a></li>
                <li><a href="./features.php">功能介紹</a></li>
                <li><a href="./members.php">成員介紹</a></li>
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