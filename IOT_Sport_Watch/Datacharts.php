<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8" />
    <title>功能介紹</title>


    <!-- bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!--- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <!--Google font setting-->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet" />
    <link href="./css/style.css" rel="stylesheet">
    <!-- cpoy from chattest.html -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js'></script>
    <script src="https://unpkg.com/vuex@3.6.2/dist/vuex.js"></script>
</head>

<body>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

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
                <li><a href="./member.php"><?php echo htmlspecialchars($_SESSION["username"]) ?></a></li>
                <li><?php if (isset($_SESSION['username'])) : ?><a href="./php/logout.php">登出</a></a><?php endif ?></li>
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
            <div class="features2">
                <div class="features2-item">
                    <p></p>
                    <div id="app">
                        <select class="form-select" aria-label="Default select example" id="tes" onchange="express()">
                            <option selected="selected" disabled>------請選擇時間-----</option>
                            <option class="ite" v-for="(item, index) in SportTables" v-on:click="seechart(item, index)">{{item}}</a>
                        </select>
                    </div>
                    <div class="main_div">
                        <div class="buttons">
                            <ul>

                                <li><a href="#distancedata" onclick="divVisibility('Div1');"><img class="distance" src="./Icons/icons8-distance-64.png" /><span>量測距離：<br />量測您移動的距離</span></a>
                                    <p class="body"> 距離 </p>

                                </li>

                                <li><a href="#heartdata" onclick="divVisibility('Div2');"> <img class="heart" src="./Icons/icons8-heart-64.png" /><span class="heart">量測心率：<br />量測您每分鐘的心跳數</span></a>
                                    <p class="body"> 心率 </p>

                                </li>

                                <li><a href="#velocity" onclick="divVisibility('Div3');"> <img class="running" src="./Icons/icons8-running-64.png" /><span class="running">量測跑步速率：<br />量測您每分鐘跑的公里數</span></a>
                                    <p class="body"> 速度 </p>

                                </li>

                                <li><a href="#Stride_Cadence" onclick="divVisibility('Div4');"><img class="footprint" src="./Icons/icons8-footprint-50.png" /><span>量測步數：<br />量測您行走的步數</span></a>
                                    <p class="body"> 步速 </p>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="features2-item2">
                    <?php if (isset($_SESSION['username'])) : ?>

                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe id="Div1" class="embed-responsive-item" frameborder="0" scrolling="no" style="height: 550px; overflow:hidden; width: 800px" src="./Datacharts/distance.html" marginheight="-1" marginwidth="-1"></iframe>
                        </div>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe id="Div2" class="embed-responsive-item" frameborder="0" scrolling="no" style="height: 550px; overflow:hidden; width: 800px" src="./Datacharts/heart.html" marginheight="-1" marginwidth="-1"></iframe>
                        </div>


                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe id="Div3" class="embed-responsive-item" frameborder="0" scrolling="no" style="height: 550px; overflow:hidden; width: 800px" src="./Datacharts/velocity.html" marginheight="-1" marginwidth="-1"></iframe>
                        </div>


                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe id="Div4" class="embed-responsive-item" frameborder="0" scrolling="no" style="height: 550px; overflow:hidden; width: 800px" src="./Datacharts/Stride_Cadence.html" marginheight="-1" marginwidth="-1"></iframe>
                        </div>
                    <?php endif ?>
                </div>

            </div>
        </div>
        <!-- 左邊內容 -->
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

    <script>
        var divs = ["Div1", "Div2", "Div3", "Div4"];
        var visibleDivId = null;

        function divVisibility(divId) {
            if (visibleDivId === divId) {
                visibleDivId = null;
            } else {
                visibleDivId = divId;
            }
            hideNonVisibleDivs();
        }

        function hideNonVisibleDivs() {
            var i, divId, div;
            for (i = 0; i < divs.length; i++) {
                divId = divs[i];
                div = document.getElementById(divId);
                if (visibleDivId === divId) {
                    div.style.display = "block";
                } else {
                    div.style.display = "none";
                }
            }
        }
        let vm = new Vue({


            el: '#app',
            data: {
                SportTables: [] //預先建立一個數組，用於存放請求得到的資料  
            },
            // methods: {
            //     seechart: function(item, index) {
            //         const axios = require('axios');
            //         var reord = item;
            //         axios.post("/Datacharts/distance.php", {
            //             record
            //         });
            //         axios.post("/Datacharts/heart.php", {
            //             record
            //         });
            //         axios.post("/Datacharts/Stride_Cadence.php", {
            //             record
            //         });
            //         axios.post("/Datacharts/velocity.php", {
            //             record
            //         });
            //     }
            // },
            // created mounted
            created() { //此處用created相當於對前端頁面資料進行初始化
                axios.get("./php/user_sport_table.php").then(res => { //這裡是ES6的寫法，get請求的地址，是小編自己在網站上存放的php檔案，後面將介紹其編寫，也可以自己定義
                    this.SportTables = res.data; //獲取資料
                    console.log('success');
                    console.log(this.SportTables);
                })
            }

        })

        function express() {
            var e = document.getElementById("tes");
            var strUser = e.options[e.selectedIndex].text;
            location.href = "./Datacharts/post_table.php?table=" + strUser;
        }
    </script>


</body>

</html>