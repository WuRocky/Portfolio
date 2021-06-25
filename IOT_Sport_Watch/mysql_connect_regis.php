<?php
// define 是將此設定為常數 與變數不同 設定以後就無法更改
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'SD89bK8vC5Pi');
define('DB_NAME_REG', 'registrationForm');
//連線到MYSQL
$conn_regis = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME_REG) or die("錯誤: 連線失敗; " . mysqli_connect_error());
