<?php
include "nav.php";
include "../login/login-check.php";
include "../dbcon/dbconnect.php";
?>
<div class="main-content">
    <div class="wrapper">
        <br>
        <h3>Manage Staffs</h3>

        <table>
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>UserType</th>
                <th>Action</th>

                <?php
                $sql = "SELECT * FROM staff WHERE `isadmin` = 0";
                $res = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($res);
                $sn = 1;
                if ($num > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $username = $row['username'];
                        $email = $row['email'];
                        $usertype = $row['usertype'];
                ?>

            <tr>
                <td><?php echo $sn++ ?></td>
                <td><?php echo $name ?></td>
                <td><?php echo $username ?></td>
                <td><?php echo $email ?></td>
                <td><?php echo $usertype ?></td>
                <td>
                    <a href="../admin/delete-staff.php?id=<?php echo $id; ?>" onclick="return confirmDel();" class="btn-danger">Delete User</a>
                </td>
            </tr>
    <?php
                    }
                }
    ?>
    </tr>
        </table>
    </div>
</div>
<script>
    function confirmDel() {
        return confirm("Are you sure you want to delete the user");
    }
</script>