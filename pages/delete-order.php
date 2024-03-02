<?php
include '../dbcon/dbconnect.php';
include '../login/login-check.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM `order_item` WHERE order_item_id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result == true) {
        // header("location: ../pages/order_list.php");
        // header('location: ')
    } else {
        // header("location: ../pages/order_list.php");
    }
} else {
}
