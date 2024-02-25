<?php
include '../dbcon/dbconnect.php';
include '../login/login-check.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo $id;
    $sql = "DELETE FROM `order_tbl` WHERE order_id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result == true) {
        header("location: ../pages/order_list.php");
    } else {
        header("location: ../pages/order_list.php");
    }
} else {
    $_SESSION['unauthorized'] = "Unauthorized access";
    header("location: http://localhost/food-order-sys/pages/order_list.php");
}
