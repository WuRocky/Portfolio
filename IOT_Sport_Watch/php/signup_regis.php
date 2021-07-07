<?php
include "mysql_connect_regis.php";
include "mysql_connect.php";


$username = $_POST['username'];
$account = $_POST['account'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$email = $_POST['email'];
$number = $_POST['phone'];
$gender = $_POST['gender'];
$birthday = $_POST['birth'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$watch = $_POST['watch'];
if ($password1 === $password2) {
    $password = password_hash($password1, PASSWORD_DEFAULT);

    $sql = "INSERT INTO recording (name, account, password, email, number, gender, birthday, height, weight, watch) VALUES('$username','$account','$password', '$email','$number', '$gender','$birthday','$height','$weight','$watch')";
    mysqli_set_charset($conn_regis, 'utf8');
    $executed_status = mysqli_query($conn_regis, $sql);
    if ($executed_status) {
        $sqlcreate = "CREATE DATABASE `" . $account . "` ";
        if (mysqli_query($conn, $sqlcreate)) {
            echo 'success';
        } else {
            echo 'database';
        }
    } else {
        echo 'account';
    }
} else {
    echo 5;
}
mysqli_close($conn);
mysqli_close($conn_regis);
