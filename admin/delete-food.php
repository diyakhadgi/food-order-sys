<?php
include '../dbcon/dbconnect.php';
include '../login/login-check.php';

if (isset($_GET['id']) && isset($_GET['image'])) {
   
    $id = $_GET['id'];
    $image = $_GET['image'];

    if($image != "") 
    {
        $path = "../image_item/".$image;

        $remove = unlink($path);

        if($remove==false) {
            // $_SESSION['upload'] = "Failed to remove image file";
            header("location: ../admin/manage-food.php");
            die();
        }
    }
    $sql = "DELETE FROM `item` WHERE `id`= $id";
    $result = mysqli_query($conn, $sql);
    if($result==true){
        // $_SESSION['delete'] = "Item Deleted Successfully";
        header("location: ../admin/manage-food.php");
    } else {
        // $_SESSION['delete'] = "Item Failed to Delete";
        header("location: ../admin/manage-food.php");
    }

} else {
    // $_SESSION['unauthorized'] = "Unauthorized Access";
    header("location: http://localhost/food-order-sys/admin/manage-food.php ");
}
