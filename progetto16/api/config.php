<?php

include("../libraries/dbLibrary.php");

$servername = "localhost"; // 127.0.0.1
$username = "root";
$password = "";
$database = "LPW";

$conn = openDB($database, $password, $username, $servername);
?>