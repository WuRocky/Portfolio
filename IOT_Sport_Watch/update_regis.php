<?php session_start(); ?>
<?php
require_once "mysql_connect_regis.php";
require_once "mysql_connect_data.php";
// 姓名
$name = $_POST['name'];
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

echo $_SESSION['username'];
echo $name;
//紅色字體為判斷密碼是否填寫正確
if ($_SESSION['username'] != null && $name != null) {
    //&& $email != null && $number != null && $gender != null && $birthday != null && $height != null && $weight != null
    $account = $_SESSION['username'];

    //更新資料庫資料語法
    $sql = "update recording set name='$name' where account='$account'";
    if (mysqli_query($conn_regis, $sql)) {
        echo '修改成功!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
    } else {
        echo '修改失敗!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
    }
} else {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>