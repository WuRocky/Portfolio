<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
    <title>功能介紹</title>


    <!-- bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!--- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <!--Google font setting-->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
    <link href="css/style_members.css" rel="stylesheet">

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
    <header class="page-header">
        <div class="logo">

            <a href="#">
                <img src="./Logo/icons8-intelligent-person-64.png" alt="智能手錶首頁">
            </a>
            <h1 class="logo-h1"><a href="./index.php">IoT Watch</a></h1>
        </div>



        <nav class="main-nav">
            <ul class="main-nav ul">
                <li><a href="index.php">首頁</a></li>

                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">裝置介紹</a>
                    <div class="dropdown-content">
                        <a href="devices.phpc">裝備使用</a>
                        <a href="features.php">功能介紹</a>
                        <a href="members.php">成員介紹</a>
                    </div>
                </li>

                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">測量圖</a>
                    <div class="dropdown-content">
                        <a href="heart.php">心跳圖</a>
                        <a href="#">速度</a>
                        <a href="#">距離</a>
                    </div>
                </li>

                <li><a href="#">影片介紹</a></li>
            </ul>
        </nav>

    </header>
    <!-- 下面右邊內容 -->
    <section>
        <div class="aside">
            <div class="features">
                <ul>
                    <li><a href="#"><img class="distance"
                                src="./Icons/icons8-distance-64.png" /><span>量測距離：<br />量測您移動的距離</span></a>
                    </li>
                    <li><a href="#"><img class="footprint"
                                src="./Icons/icons8-footprint-50.png" /><span>量測步數：<br />量測您行走的步數</span></a>
                    </li>
                    <li><a href="#"><img class="temperature" src="./Icons/icons8-temperature-inside-64.png" /><span
                                class="temperature">量測溫溼度：<br />量測環境溫濕度是否適宜運動</span></a>
                    </li>
                    <li><a href="#"> <img class="heart" src="./Icons/icons8-heart-64.png" /><span
                                class="heart">量測心率：<br />量測您每分鐘的心跳數</span></a>
                    </li>
                    <li><a href="#"> <img class="running" src="./Icons/icons8-running-64.png" /><span
                                class="running">量測跑步速率：<br />量測您每分鐘跑的公里數</span></a>
                    </li>
                </ul>
            </div>
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