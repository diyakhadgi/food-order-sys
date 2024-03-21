<?php
include '../dbcon/dbconnect.php';
include '../login/login-check.php';
?>
<?php
$id = $_GET['id'];

$sql = "DELETE FROM staff WHERE id=$id";
$result = mysqli_query($conn, $sql);

if ($result == TRUE) {
    // echo "Admin Deleted";
    // $_SESSION['delete'] = "Admin Deleted Successfully";
    header("location: ../admin/manage-staff.php");
} else {
    // $_SESSION['delete'] = "Failed to delete Admin";
    header("location: ../admin/manage-admin.php");
}

?>