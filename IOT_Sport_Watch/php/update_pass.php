<?php
session_start();
include "mysql_connect_regis.php";

$username = mysqli_real_escape_string($conn_regis, $_SESSION['username']);
$old_pass = mysqli_real_escape_string($conn_regis, $_POST['old_pass']);
$new_pass1 = mysqli_real_escape_string($conn_regis, $_POST['new_pass1']);
$new_pass2 = mysqli_real_escape_string($conn_regis, $_POST['new_pass2']);

if ($username != "") {
    $sql_old_pass = "SELECT * FROM recording where account = '$username'";
    $result = mysqli_query($conn_regis, $sql_old_pass);
    $row = array();
    $row = mysqli_fetch_row($result);
    if ($row[1] == $username) {
        if (password_verify($old_pass, $row[2])) {
            if ($new_pass1 === $new_pass2) {
                $password = password_hash($new_pass1, PASSWORD_DEFAULT);
                $sql = "UPDATE recording  SET password='$password' WHERE account='$account'";
                if (mysqli_query($conn_regis, $sql)) {
                    echo 'success';
                }
            } else {
                echo 'NT';
            }
        } else {
            echo 'old_pass_err';
        }
    } else {
        echo 'username_err';
    }
} else {
    echo 'not_uername';
}

mysqli_close($conn_regis);
