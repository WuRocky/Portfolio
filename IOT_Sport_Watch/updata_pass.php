<?php
session_start();
//不能寫/php/mysql_connect_regis.php 會發生問題
require_once "php/mysql_connect_regis.php";
$account = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
    <title>功能介紹</title>


    <!-- bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!--- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <!--Google font setting-->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
    <!-- cpoy from chattest.html -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js'></script>
    <script src="https://unpkg.com/vuex@3.6.2/dist/vuex.js"></script>

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

            </div>
        </div>
        <div class="container">

            <nav class="main-nav">
                <li><a href="member.php"><?php echo htmlspecialchars($_SESSION["username"]) ?></a></li>
                <li><a href="./php/logout.php">登出</a></li>
                <li><a href="index.php">首頁</a></li>

                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">裝置介紹</a>
                    <div class="dropdown-content">
                        <a href="devices.php">裝備使用</a>
                        <a href="features.php">功能介紹</a>
                        <a href="members.php">成員介紹</a>
                    </div>
                </li>
                <li class="dropdown" id="app">
                <li><a href="./Datacharts.php">測量圖</a></li>
                <li><a href="video.php">影片介紹</a></li>
            </nav>

        </div>

    </header>
    <!-- 下面右邊內容 -->
    <section>
        <form action="./php/update_pass.php" method="POST">
            <div class="aside">
                <div class="features">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0 col-form-label">帳號</h6>
                                    </div>
                                    <input class="col-sm-9 text-secondary" type="text" name="username" id="username" value="<?php echo htmlspecialchars($_SESSION["username"]) ?>" disabled>
                                    <div id="username_err" style="display:inline"></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0 col-form-label">舊密碼</h6>
                                    </div>
                                    <input class="col-sm-9 text-secondary" type="password" name="old_pass" id="old_pass" placeholder="請輸入舊密碼" checked require>
                                    <div id="old_pass_err" style="display:inline"></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0 col-form-label">新密碼</h6>
                                    </div>
                                    <input class="col-sm-9 text-secondary" type="password" name="new_pass1" id="new_pass1" placeholder="請輸入新密碼" require>
                                    <div id="new_pass1_err" style="display:inline"></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0 col-form-label">確認新密碼</h6>
                                    </div>
                                    <input class="col-sm-9 text-secondary" type="password" name="new_pass2" id="new_pass2" placeholder="請確認新密碼" require>
                                    <div id="new_pass2_err" style="display:inline"></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-info" id="but_updata">確認</buttton>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- 左邊內容 -->
        <div class="side">
            <ul class="side-item">
                <li><a href="./member.php">查詢資料</a></li>
                <li><a href="./updata_pass.php">修改密碼</a></li>
                <li><a href="./php/delete_account.php">刪除帳號</a></li>
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
        $(document).ready(function() {
            $("form").submit(function(event) {
                event.preventDefault();
                $("#old_pass_err").html("");
                $("#new_pass1_err").html("");
                $("#new_pass2_err").html("");

                var old_pass = $("#old_pass").val().trim();
                var new_pass1 = $("#new_pass1").val().trim();
                var new_pass2 = $("#new_pass2").val().trim();

                $.ajax({
                    url: './php/update_pass.php',
                    type: 'POST',
                    data: {
                        "old_pass": old_pass,
                        "new_pass1": new_pass1,
                        "new_pass2": new_pass2,
                    },
                    success: function(response) {
                        switch (response) {
                            case 'success':
                                window.location = "./php/logout.php";
                                break;
                            case 'NT':
                                $("#new_pass2_err").html("兩次密碼不相同");
                                break;
                            case 'old_pass_err':
                                $("#old_pass_err").html("舊密碼輸入錯誤");
                                break;
                            case 'username_err':
                                $("#username_err").html("找不到此帳號");
                                break;
                            case 'not_uername':
                                $("#username_err").html("請先登入帳號");
                                break;
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>