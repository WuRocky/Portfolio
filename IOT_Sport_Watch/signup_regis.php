<?php
require_once "mysql_connect_regis.php";
require_once "mysql_connect_data.php";
// 姓名
$name = $_POST['name'];
// 帳號
$account = $_POST['username'];
// 密碼
$password1 = password_hash($_POST['password1'], PASSWORD_DEFAULT);
// 信箱
$email = $_POST['email'];
// 手機
$number = $_POST['phone'];
// 性別
$gender = $_POST['gender'];
// 生日
$birthday = $_POST['selectdate'];
// 身高
$height = $_POST['height'];
// 體重
$weight = $_POST['weight'];
// 手錶序號
$watch = $_POST['watch'];

//新增註冊帳號至mysql
if ($name != null && $account != null && $password1 != null && $email != null && $number != null && $gender != null && $birthday != null && $height != null && $weight != null) {
    $sql = "INSERT INTO recording (name, account, password, email, number, gender, birthday, height, weight, watch) VALUES('$name','$account','$password1','$email','$number','$gender','$birthday','$height','$weight','$watch')";

    mysqli_set_charset($conn_regis, 'utf8');

    $executed_status = mysqli_query($conn_regis, $sql);

    if ($executed_status) {
        // echo '已成功新增了此筆資料錄！';
        $sqlcreate = "CREATE DATABASE `" . $account . "` ";
        if (mysqli_query($conn_data, $sqlcreate)) {
            echo "Table MyGuests created successfully";
            header("Location:login.php");
        } else {
            echo "Error creating table: " . mysqli_error($conn_data);
        }
    } else {
        echo '新增此筆資料錄失敗了...。其原因：' . mysqli_error($conn_regis);
    }
} else {
    header("Location:signup.php");
    echo '不能有空值';
}

mysqli_close($conn_data);
mysqli_close($conn_regis);
