<?php
// include 'nav.php';
include '../login/login-check.php';
?>
<div class="main-content">
    <div class="wrapper">
        <br>
        <h3>MANAGE FOOD</h3> <br>
        <!-- button to add admin  -->
        <a href="../admin/add-food.php" class="btn-">Add Food</a> <br> <br><br>
        <table class="" border="1">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            <?php
            include '../dbcon/dbconnect.php';
            $sql = "SELECT * FROM item";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            $sn = 1;
            if ($num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td>
                                <img src="<?php echo $row['image'] ?>" alt="<?php echo "Image of".$row['title']?>">;
                        </td>
                        <td><?php echo $row['price']; ?></td>
                        <td>
                            <a href="#" class="btn-">Update Item</a>
                            <a href="#" class="btn-">Delete Item</a>
                        </td>
                    </tr>
<?php
                }
            } else {
                echo "<tr> <td colspans='7'> Food not added yet. </td></tr>";
            }
?>
        </table>
    </div>
</div>