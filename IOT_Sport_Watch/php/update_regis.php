<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
</head>

<body>

</body>

</html>
<?php session_start(); ?>
<?php
require_once "mysql_connect_regis.php";
require_once "mysql_connect_data.php";

$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['phone'];
$gender = $_POST['gender'];
$birthday = $_POST['selectdate'];
$height = $_POST['height'];
$weight = $_POST['weight'];

//判斷是否有登入帳號，現在只用name做測試
if ($_SESSION['username'] != null) {
    if ($name != NULL && $email != NULL) {

        //&& $email != null && $number != null && $gender != null && $birthday != null && $height != null && $weight != null
        $account = $_SESSION['username'];

        $sql = "UPDATE recording  SET name='$name', email='$email', number='$number', gender='$gender', birthday='$birthday', height='$height', weight='$weight', watch='$watch' WHERE account='$account'";
        //更新對應的帳號，使此筆資料更新到資料表
        if (mysqli_query($conn_regis, $sql)) {
            //echo '修改成功!';
            echo '<meta http-equiv=REFRESH CONTENT=0.001;url="../member.php">';
        } else {
            //echo '修改失敗!';*
            echo '<meta http-equiv=REFRESH CONTENT=0.001;url="../member.php">';
        }
    } else {
        echo '不能有空值';
        echo '<meta http-equiv=REFRESH CONTENT=0.001;url="../member.php">';
    }
} else {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=0.001;url="../member.php">';
}
?>