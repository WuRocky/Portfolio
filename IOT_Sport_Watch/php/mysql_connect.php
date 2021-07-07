<?php
session_start();
$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = "SD89bK8vC5Pi"; /* Password */

$conn = mysqli_connect($host, $user, $password);
// Check connection
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME_REG) or die("錯誤: 連線失敗; " . mysqli_connect_error());
