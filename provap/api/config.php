<?php

$servername = "localhost"; // 127.0.0.1
$username = "root";
$password = "";
$database = "LPW";

$conn = mysqli_connect($servername,$username,$password,$database)
or die("MySQL connect error ".mysqli_connect_error($conn));

?>