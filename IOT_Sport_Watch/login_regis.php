<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<?php
//連接資料庫
//只要此頁面上有用到連接MySQL就要include它


require_once "mysql_connect_regis.php";

$account = $_POST['username'];
$password = $_POST['password'];

//搜尋資料庫資料
$sql = "SELECT * FROM recording where account = '$account'";
$result = mysqli_query($conn_regis, $sql);
$row = @mysqli_fetch_row($result);

//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
if ($account != null && $password != null) {
    if ($row[1] == $account) {
        if (password_verify($password, $row[2])) {
            //將帳號寫入session，方便驗證使用者身份
            $_SESSION['username'] = $account;
            $_SESSION["loggedin"] = true;
            //echo '登入成功!';
            echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
        }
    }
} else {
    echo '登入失敗!';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=login.php>';
}

mysqli_close($conn_regis);
?>