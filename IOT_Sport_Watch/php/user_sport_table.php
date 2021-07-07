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
//
$account = $_SESSION['username'];

define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'SD89bK8vC5Pi');
$conn_user = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
//選取當前此帳戶的資料苦底下的資料表
$sql = "SHOW TABLES FROM `" . $account . "`";
$executed_status = mysqli_query($conn_user, $sql);

if ($executed_status) {
    while ($row = @mysqli_fetch_row($executed_status)) {
        $i = 0;
        while ($row[$i] != NULL) {
            echo "$row[$i]<br>";
            $i = $i + 1;
        }
    }
}
mysqli_close($conn_user);
