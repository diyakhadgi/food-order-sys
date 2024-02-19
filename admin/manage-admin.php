<?php include('nav.php');
include '../dbcon/dbconnect.php';
include '../login/login-check.php';
?>
<div class="main-content">
    <div class="wrapper">
        <br>
        <h3>MANAGE ADMIN</h3> <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <br><br>
        <a href="add-admin.php" class="btn-primary">Add Admin</a> <br> <br><br>
        <table class="tbl">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            include '../dbcon/dbconnect.php';
            $sql = "SELECT * FROM staff WHERE `isadmin` = 1";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            $sn = 1;
            if ($num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $username = $row['username'];
                    $email = $row['email'];
            ?>

                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $name ?></td>
                        <td><?php echo $username ?></td>
                        <td>
                            <a href="../admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                            <a href="../admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>

            <?php
                }
            } else {
            }
            ?>
        </table>
    </div>
</div>

</html>