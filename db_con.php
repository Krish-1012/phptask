<?php
date_default_timezone_set('Asia/Kolkata');
$connection = mysqli_connect('localhost', 'root', '') OR die('database Not Connected');
mysqli_select_db($connection, 'webconnect');
mysqli_set_charset($connection,"utf8");
?>