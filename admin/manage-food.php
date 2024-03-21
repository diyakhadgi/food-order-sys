<?php
include 'nav.php';
include '../login/login-check.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script>
        function confirmDel() {
            return confirm("Are you sure you want to delete this item?");
        }
    </script>
</head>

</html>
<div class="main-content">
    <div class="wrapper">
        <br>
        <h3>MANAGE FOOD</h3> <br>

        <!-- <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['unauthorized'])){
                echo $_SESSION['unauthorized'];
                unset($_SESSION['unauthorized']);
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?> <br><br> -->
        <a href="../admin/add-food.php" class="btn-primary">Add Food</a> <br> <br><br>
        <table class="item-tbl">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Price</th>
                <th colspan="2">Actions</th>
                <th></th>
            </tr>
            <?php
            include '../dbcon/dbconnect.php';
            $sql = "SELECT * FROM item";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            $sn = 1;
            if ($num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $image = $row['image'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td>
                            <img src="<?php echo $row['image'] ?>" alt="<?php echo "Image of" . $row['title'] ?>" class="item" height="200px" width="200px">
                        </td>
                        <td><?php echo 'Rs.' . $row['price']; ?></td>
                        <td colspan="2" class="widi">
                            <a href="../admin/update-food.php?id=<?php echo $id;?>" class="btn-sec">Update Item</a>
                        </td>
                        <td class="widi">
                            <a href="../admin/delete-food.php?id=<?php echo $id; ?>&image=<?php echo $row['image']; ?>" onclick="return confirmDel();" class="btn-dan">Delete Item</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr> <td colspans='6'> Food not added yet. </td></tr>";
            }
            ?>
        </table>
    </div>
</div>