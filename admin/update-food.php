<?php
include '../dbcon/dbconnect.php';
include '../admin/nav.php';
include '../login/login-check.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM `item` WHERE `id` = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $title = $row['title'];
    $description = $row['description'];
    $price = $row['price'];
    $image = $row['image'];
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1> <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" id="" value="<?php echo $title ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5">
                    <?php echo $description ?>
                    </textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" id="" value="<?php echo $price ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <!-- display the image  -->
                        <img src="<?php echo $row['image'] ?>" alt="<?php echo "Image of" . $row['title'] ?>" class="item" height="200px" width="200px">
                    </td>
                </tr>
                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image" id="">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                    </td>
                    <td>
                        <input type="submit" name="submit" id="" value="Update item" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];

            // Initialize an empty array to store the fields and values to be updated
            $update_fields = [];

            // Check if each field is set in the form data, and add it to the $update_fields array if it is
            if (isset($_POST['title'])) {
                $update_fields[] = "`title` = '" . $_POST['title'] . "'";
            }
            if (isset($_POST['description'])) {
                $update_fields[] = "`description` = '" . $_POST['description'] . "'";
            }
            if (isset($_POST['price'])) {
                $update_fields[] = "`price` = '" . $_POST['price'] . "'";
            }
            if ($_FILES['image']['name'] != '') {
                $image = $_FILES['image']['name'];
                $temp = $_FILES['image']['tmp_name'];
                $folder = '../image_item/' . $image;
                move_uploaded_file($temp, $folder);
                $update_fields[] = "`image` = '" . $folder . "'";
            }

            // Build the SQL UPDATE statement using the fields and values from the $update_fields array
            $sql1 = "UPDATE `item` SET " . implode(", ", $update_fields) . " WHERE `id` = $id";

            $result1 = mysqli_query($conn, $sql1);
            if ($result1 == true) {
                header("location: ../admin/manage-food.php");
            } else {
                header("location: ../admin/manage-food.php");
            }
        }
        ?>
    </div>
</div>
