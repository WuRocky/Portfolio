<?php
session_start();
header("Access-Control-Allow-Origin: *"); //這個必寫，否則報錯

$account = $_SESSION['username'];
$table = $_SESSION['table'];

$mysqli = new mysqli('localhost', 'root', 'SD89bK8vC5Pi', $account); //根據自己的資料庫填寫



$sql = "SELECT Reading_time, Stride_Cadence FROM `" . $table . "` order by Reading_time desc limit 40";
$res = $mysqli->query($sql);

$arr = array();
while ($row = $res->fetch_assoc()) {
    $arr[] = $row;
}

$reversedArray = array_reverse($arr);

$res->free();
//關閉連線
$mysqli->close();

echo (json_encode($reversedArray));//這裡用echo而不是return
