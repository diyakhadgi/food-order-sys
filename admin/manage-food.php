<?php
include 'nav.php';
include '../login/login-check.php';
?>
<div class="main-content">
    <div class="wrapper">
    <br>
            <h3>MANAGE FOOD</h3> <br>
        <!-- button to add admin  -->
        <a href="../admin/add-food.php" class="btn-primary">Add Food</a> <br> <br><br>
            <table class="tbl">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Momo</td>
                    <td>very thicc and juicy</td>
                    <td></td>
                    <td>
                        <a href="#" class="btn-secondary">Update Admin</a>
                        <a href="#" class="btn-secondary">Delete Admin</a>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Diya Khadgi</td>
                    <td>diyak</td>
                    <td>
                        Update Admin
                        Delete Admin
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Diya Khadgi</td>
                    <td>diyak</td>
                    <td>
                        Update Admin
                        Delete Admin
                    </td>
                </tr>
            </table>
    </div>
</div>