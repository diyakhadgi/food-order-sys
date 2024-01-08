<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "foodordersys";
$conn = mysqli_connect($server, $user, $password, $db);
if (!$conn) {
    echo "Database connected";
}
?>