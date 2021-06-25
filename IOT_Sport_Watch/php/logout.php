<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//將登入帳號、有登入、個人資料的session清空
unset($_SESSION['username']);
unset($_SESSION["loggedin"]);
unset($_SESSION["profile"]);
//一次刪除所有暫存的SESSION
session_destroy();
echo '<meta http-equiv=REFRESH CONTENT=0.0001;url="../index.php">';
?>
<!-- 登出的按鈕寫上action="/php/logout.php" method="POST"，就可以觸發 -->