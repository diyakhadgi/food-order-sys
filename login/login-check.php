<?php
// authorization check 
session_start();
$profile = $_SESSION['username'];
if (!$profile) {
    header("location: http://localhost/food-order-sys/index.html");
    exit(); 
}
?>