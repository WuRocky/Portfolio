<?php
session_start();
//連接資料庫
//只要此頁面上有用到連接MySQL就要include它
include "mysql_connect_regis.php";



//前端post到後端設個變數讓他接收
$account =  mysqli_real_escape_string($conn_regis, $_POST['username']);
$password =  mysqli_real_escape_string($conn_regis, $_POST['password']);

//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
if ($account != NULL && $password != NULL) {
    //判斷篩選回來的帳號是否相同
    $sql = "SELECT * FROM recording where account = '$account'";
    //搜尋資料庫資料
    $result = mysqli_query($conn_regis, $sql);
    //將篩選回來的結果儲存
    $row = @mysqli_fetch_row($result);
    if ($row[1] == $account) {
        //將密碼解密，並判斷篩選回來的密碼是否相*同
        if (password_verify($password, $row[2])) {
            //將帳號寫入session，方便驗證使用者身份
            $_SESSION['username'] = $account;
            //將現在有登入的帳號寫入，以做後續的判斷
            $_SESSION["loggedin"] = true;
            //echo '登入成功!';
            echo 'success';
        } else {
            echo 'password_error';
        }
    } else {
        echo 'account_error';
    }
} else {
    echo 'NULL';
}
//每次連線完都要斷開連結
mysqli_close($conn_regis);
