<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
</head>

<body>

</body>

</html>
<?php
session_start();
$DB_SERVER = 'localhost';
$DB_USERNAME = 'root';
$DB_PASSWORD = 'SD89bK8vC5Pi';
$DB_NAME_REGIS = 'registrationForm';

$account = $_SESSION['username'];

$conn_reg = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME_REGIS);
$conn = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD);

if (!$conn_reg) {
    die('連線失敗...。其原因：' . mysqli_connect_error($conn_reg));
}
if (!$conn) {
    die('連線失敗...。其原因：' . mysqli_connect_error($conn));
}

$sql_delete_acc = "DELETE FROM recording WHERE account='$account'";
$sql_delete_data = "DROP DATABASE  `" . $account . "`";

if (mysqli_query($conn, $sql_delete_data)) {
    echo "已成功刪除帳號的資料庫";
    if (mysqli_query($conn_reg, $sql_delete_acc)) {
        echo "已成功刪除帳號";
        header("Location:logout.php");
    } else
        echo "出了點問題" . mysqli_error($conn_reg);
} else {
    echo "刪除資料庫出了點問題" . mysqli_error($conn);
}
?>