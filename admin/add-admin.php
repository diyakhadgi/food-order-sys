<?php
include('nav.php');
include '../dbcon/dbconnect.php';
include '../login/login-check.php';
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        <?php

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="name" id="" placeholder="Enter full name" required>
                    </td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="email" name="email" id="" required>
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" id="" placeholder="Username" required>
                    </td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" id="" placeholder="Password" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" id="" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
    include '../dbcon/dbconnect.php';
    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = "INSERT into staff (`username`, `password`, `email`, `name`, `usertype`, `isadmin`) VALUES ('$username', '$password', '$email', '$name', 'admin', '1')";
    
        $res = mysqli_query($conn, $sql);

        if($res==TRUE)
        {
            $_SESSION['add'] = "Admin Added Successfully";
            header('location:http://localhost/food-order-sys/admin/manage-admin.php');
        } 
        else {
            $_SESSION['add'] = "Failed to Add Admin";
            header("location:http://localhost/food-order-sys/admin/manage-admin.php");
        }
    }
?>