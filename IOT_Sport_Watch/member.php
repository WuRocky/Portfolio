<?php
session_start();
require_once "/php/mysql_connect_regis.php";


$account = $_SESSION['username'];
$sql = "SELECT * FROM recording WHERE account = '$account'";
$result = mysqli_query($conn_regis, $sql);

$_SESSION['profile'] = array();
$i = 0;

while ($row = mysqli_fetch_row($result)) {
    while ($row[$i] != NULL) {
        array_push($_SESSION['profile'], $row[$i]);
        $i += 1;
    }
}
?>

<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
    <title>個人資料</title>


    <!-- bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!--- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <!--Google font setting-->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
    <link href="css/style_members.css" rel="stylesheet">

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
                <li><a href="/php/logout.php">登出</a></li>
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
        <form action="/php/update_regis.php" method="POST">
            <div class="aside">
                <div class="features">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0 col-form-label">姓名</h6>
                                    </div>
                                    <input class="col-sm-9 text-secondary" type="text" name="name" placeholder="<?php
                                                                                                                $i = 0;
                                                                                                                echo  $_SESSION['profile'][$i]
                                                                                                                ?>">
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0 col-form-label">帳號</h6>
                                    </div>
                                    <input class="col-sm-9 text-secondary" type="text" name="username" value="<?php
                                                                                                                $i = 1;
                                                                                                                echo  $_SESSION['profile'][$i]
                                                                                                                ?>" disabled>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0 col-form-label">信箱郵件</h6>
                                    </div>
                                    <input class="col-sm-9 text-secondary" type="text" name="email" value="<?php
                                                                                                            $i = 3;
                                                                                                            echo  $_SESSION['profile'][$i]
                                                                                                            ?>">
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0 col-form-label">電話</h6>
                                    </div>
                                    <input class="col-sm-9 text-secondary" type="text" name="phone" value="<?php
                                                                                                            $i = 4;
                                                                                                            echo  $_SESSION['profile'][$i]
                                                                                                            ?>">
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 for="gender" class="mb-0 col-form-label">性別</h6>
                                    </div>
                                    <input class="col-sm-9 text-secondary" type="text" name="gender" value="<?php $i = 5;
                                                                                                            $male = 'male';
                                                                                                            $female = 'female';
                                                                                                            $gender = '';
                                                                                                            if ($gender = ($_SESSION['profile'][$i] == $male) ? "男姓" : "女性") echo  $gender ?>" disabled>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 for="birth" class="mb-0 col-form-label">生日</h6>
                                    </div>
                                    <input class="col-sm-9 text-secondary" type="date" name="selectdate" value="<?php
                                                                                                                $i = 6;
                                                                                                                echo  $_SESSION['profile'][$i]
                                                                                                                ?>">
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0 col-form-label">身高</h6>
                                    </div>
                                    <input class="col-sm-9 text-secondary" type="text" name="height" value="<?php
                                                                                                            $i = 7;
                                                                                                            echo  $_SESSION['profile'][$i]
                                                                                                            ?>">
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0 col-form-label">體重</h6>
                                    </div>
                                    <input class="col-sm-9 text-secondary" type="text" name="weight" value="<?php
                                                                                                            $i = 8;
                                                                                                            echo  $_SESSION['profile'][$i]
                                                                                                            ?>">
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0 col-form-label">手錶序號</h6>
                                    </div>
                                    <input class="col-sm-9 text-secondary" type="text" value="<?php
                                                                                                $i = 9;
                                                                                                echo  $_SESSION['profile'][$i]
                                                                                                ?>" disabled>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <a class="btn btn-info " href=" ">新增</a>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-info">修改</buttton>
                                    </div>
                                    <div class="col">
                                        <a class="btn btn-info " href=" ">刪除</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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