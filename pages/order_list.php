<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Food Ordering System</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/item.css">
    <link rel="stylesheet" href="../css/orderpopup.css">
</head>

<body>
    <nav>
        <div class="left">
            <a href="../pages/waiter_home.php">Online Food Ordering System</a>
        </div>
        <div class="right">
            <a href="../pages/waiter_home.php">Home</a>
            <a href="../pages/order_list.php">Order List</a>
            <a href="../register/register.php">Checkout</a>
            <a href="#">Contact</a>
            <a href="../login/logout.php">Logout</a>
        </div>
    </nav>
</body>
<div class="main-content">
    <div class="wrapper">
        <br>
        <h3>Order List</h3> <br>
        <a href="../admin/add-food.php" class="btn-primary">Add Food</a> <br> <br><br>
        <table class="item-tbl">
            <tr>
                <th>S.N.</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th colspan="3"></th>
            </tr>
            <?php
            include '../dbcon/dbconnect.php';
            include '../login/login-check.php';

            $sql = "SELECT item.title, item.price, order_tbl.qty from item inner join order_tbl on item.id = order_tbl.item_id where order_tbl.user_id = $profile";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $sn = 1;
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['price']; ?> </td>
                        <td><?php echo $row['qty'];?></td>
                        <td>
                        <div class="quantity">
                            <button class="btn minus-btn disabled" type="button">-</button>
                            <input type="text" name="quantity" id="quantity" value="1" class="qty" readonly="true">
                            <button class="btn plus-btn" type="button">+</button>
                        </div>
                        </td>
                        <td>
                            <a href="../pages/delete-order.php?id=<?php echo $id;?>">Remove</a>
                        </td>

                    </tr>
            <?php
                }
            } else {
                echo "Something went wrong";
            }
            ?>
        </table>
        <script src="../pages/order.js"></script>
        </body>
</html>