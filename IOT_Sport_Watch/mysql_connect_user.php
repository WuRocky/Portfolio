<?php
//使用SESSION需要引入這條
session_start();
//寫入使用者帳號，此帳號哪裡來請看login_regis.php
$account = $_SESSION['username'];
//定義常量，定義後無法做更動
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'SD89bK8vC5Pi');
define('DB_NAME_USER', "$account");

//連接到MYSQL的此帳號的資料庫
$conn_user = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME_USER);

//檢查連線是否正常
if ($conn_regis === false) {
    die("錯誤: 連線失敗; " . mysqli_connect_error());
} else {
    $date = "D" . (string)date("Y-m-d-H-i-s", time() + 8 * 60 * 60);
    $sqlcreate = "CREATE TABLE `" .  str_replace("-", "", $date) . "` (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Sensor VARCHAR(30) NOT NULL,
        Location VARCHAR(30) NOT NULL,
        Heart_Rate FLOAT,
        Stride_Cadence FLOAT,
        Velocity FLOAT,
        Distance FLOAT,
        Reading_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
    //建立當下日期時間的資料表
    if (mysqli_query($conn_user, $sqlcreate)) {
        //回到此頁面
        header("Location:login.php");
    } else {
        echo "無法創建資料表: " . mysqli_error($conn_user);
    }
}
