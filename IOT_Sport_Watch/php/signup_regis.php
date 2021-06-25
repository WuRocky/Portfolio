<?php
require_once "mysql_connect_regis.php";
require_once "mysql_connect_data.php";
//前端POST資料到此變數內
$name = $_POST['name'];
$account = $_POST['username'];
//加密使用者密碼
$password1 = password_hash($_POST['password1'], PASSWORD_DEFAULT);
$email = $_POST['email'];
$number = $_POST['phone'];
$gender = $_POST['gender'];
$birthday = $_POST['selectdate'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$watch = $_POST['watch'];

//判斷是否有無空值
if ($name != null && $account != null && $password1 != null && $email != null && $number != null && $gender != null && $birthday != null && $height != null && $weight != null) {
    //在recording資料表底下使用sql新增資料的方式
    $sql = "INSERT INTO recording (name, account, password, email, number, gender, birthday, height, weight, watch) VALUES('$name','$account','$password1','$email','$number','$gender','$birthday','$height','$weight','$watch')";

    mysqli_set_charset($conn_regis, 'utf8');
    //上傳資料
    $executed_status = mysqli_query($conn_regis, $sql);
    //判斷是否有成功
    if ($executed_status) {
        $sqlcreate = "CREATE DATABASE `" . $account . "` ";
        //創建此帳號的資料庫
        if (mysqli_query($conn_data, $sqlcreate)) {
            //成功創建導回登入頁面
            header("Location:'../login.php'");
        } else {
            echo "建立此帳號資料表失敗。原因: " . mysqli_error($conn_data);
        }
    } else {
        echo '新增此比資料失敗。其原因：' . mysqli_error($conn_regis);
    }
} else {
    //失敗導回創建頁面
    header("Location:'../signup.php'");
}
//段開資料庫連線
mysqli_close($conn_data);
mysqli_close($conn_regis);
