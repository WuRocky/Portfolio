<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
require_once "mysql_connect_regis.php";
echo '<a href="logout.php">登出</a>  <br><br>';

//此判斷為判定觀看此頁有沒有權限
//說不定是路人或不相關的使用者
//因此要給予排除
if ($_SESSION['username'] != null) {
    echo '<a href="signup.php">新增</a>    ';
    echo '<a href="update_regis.php">修改</a>    ';
    echo '<a href="delete.php">刪除</a>  <br><br>';

    $account = $_SESSION['username'];
    //將資料庫裡的所有會員資料顯示在畫面上
    $sql = "SELECT * FROM recording where account = '$account'";
    $result = mysqli_query($conn_regis, $sql);
    while ($row = mysqli_fetch_row($result)) {
        echo "$row[0] - 名字(帳號)：$row[1], " .
            "電話：$row[3], 地址：$row[4], 備註：$row[5]<br>";
    }
} else {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>