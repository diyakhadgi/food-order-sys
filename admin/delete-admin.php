<?php
include '../dbcon/dbconnect.php';
session_start();
$profile = $_SESSION['username'];
if($profile==true)
{

}
else {
    header('location:http://localhost/food-order-sys/index.html');
}
?>
<?php
$id = $_GET['id'];

$sql = "DELETE FROM staff WHERE id=$id";
$result = mysqli_query($conn, $sql);

if($result == TRUE)
{
    // echo "Admin Deleted";
    $_SESSION['delete'] = "Admin Deleted Successfully";
    header("location: ../admin/manage-admin.php");
} else{
    $_SESSION['delete'] = "Failed to delete Admin";
    header("location: ../admin/manage-admin.php");
}

?>