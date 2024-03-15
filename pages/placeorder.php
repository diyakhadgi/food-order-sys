<?php
$oid = $_GET['order_id'];
session_start();
$type = $_SESSION['usertype'];
$profile = $_SESSION['id'];
if (!$profile) {
    header("location: http://localhost/food-order-sys/pages/index.php");
    exit();
}
include '../dbcon/dbconnect.php';
if ($type == "KITCHEN" && isset($_POST['update'])) {
    $iid = $_POST['foodid'];
    $serveSQL = "UPDATE order_item SET hasServed = 1 WHERE item_id = '$iid' AND order_id = '$oid' AND hasServed = '0'";
    echo $serveSQL;
    $response = mysqli_query($conn, $serveSQL);
    if ($response) {
        echo "Done";
        header("location:http://localhost/food-order-sys/pages/vieworder.php?order_id=".$oid);
    }
}
