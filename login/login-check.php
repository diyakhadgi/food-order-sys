<?php
// authorization check 
session_start();
$profile = $_SESSION['id'];
if (!$profile) {
    header("location: http://localhost/food-order-sys/pages/index.php");
    exit(); 
}
?>