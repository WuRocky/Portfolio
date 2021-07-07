<?php
session_start();
// define 是將此設定為常數 與變數不同 設定以後就無法更改
$table = $_GET['table'];
$table = substr($table, 3, -3);
if ($table != NULL) {
    $_SESSION["table"] = $table;
    echo '<meta http-equiv=REFRESH CONTENT=1;url="../Datacharts.php">';
} else {
    echo '<meta http-equiv=REFRESH CONTENT=1;url="../index.php">';
}
