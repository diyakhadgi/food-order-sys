<?php
include '../dbcon/dbconnect.php';
include '../login/login-check.php';
session_start();
$profile = $_SESSION['username'];
if (!$profile) {
    header("location: http://localhost/food-order-sys/index.html");
    exit(); 
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php
        if (isset($_GET['id'])) { 
            $id = $_GET['id'];
            $sql = "SELECT * FROM staff WHERE id = $id";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);

            if ($num == 1) {
                $row = mysqli_fetch_assoc($result);

                $name = $row['name'];
                $email = $row['email'];
                $username = $row['username'];
            } else {
                header("location:http://localhost/food-order-sys/admin/manage-admin.php");
                exit(); 
            }
        } else {
            header("location:http://localhost/food-order-sys/admin/manage-admin.php");
            exit(); 
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="name" id="" value="<?php echo $name ?>">
                    </td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="email" name="email" id="" value="<?php echo $email ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" id="" placeholder="Username" value="<?php echo $username ?>">
                    </td>
                </tr>
                <tr>
                    <td>Old Password: </td>
                    <td>
                        <input type="password" name="password" id="" placeholder="Old Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="npassword" id="" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php
include '../dbcon/dbconnect.php';
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); 
    $npassword = md5($_POST['npassword']); 
    
    $sql = "SELECT password FROM staff WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $oldPasswordDB = $row['password']; 

    if ($password == $oldPasswordDB) {
        
        $updateQuery = "UPDATE staff SET
        `name` = '$name',
        `email` = '$email',
        `username` = '$username',
        `password` = '$npassword'
        WHERE `id` = '$id'";

        $result = mysqli_query($conn, $updateQuery);
        if ($result) {
            $_SESSION['update'] = "Admin Updated";
            header('location:http://localhost/food-order-sys/admin/manage-admin.php');
            exit();
        } else {
            $_SESSION['update'] = "Failed to update admin";
            header("location: http://localhost/food-order-sys/admin/manage-admin.php");
            exit();
        }
    } else {
        $_SESSION['update'] = "Old password is incorrect";
        header("location: http://localhost/food-order-sys/admin/manage-admin.php");
        exit();
    }
}
?>
