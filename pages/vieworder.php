<?php
$oid = $_GET['order_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../dbcon/dbconnect.php';
    if (isset($_POST['update'])) {
        $newqty = $_POST['quantity'];
        $item_id = $_POST['item_id'];
        $sql3 = "SELECT price from item WHERE id = $item_id";
        $priceres = mysqli_query($conn, $sql3);
        if ($priceres && mysqli_num_rows($priceres) > 0) {
            $price_row = mysqli_fetch_assoc($priceres);
            $price = $price_row['price'];
        $tot = $newqty * $price;
        }
        $sql2 = "UPDATE order_item AS ot
                 INNER JOIN orders AS o ON o.order_id = ot.order_id
                 SET ot.qty = '$newqty' , ot.total = '$tot'
                 WHERE ot.order_id = '$oid' AND o.hascheckout = 0 AND ot.item_id = '$item_id'";

        $res = mysqli_query($conn, $sql2);

        if ($res) {
            // echo "Updated";
        } else {
            echo "Not updated";
        }
    }
}
?>
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

    <div class="main-content">
        <div class="wrapper">
            <br>
            <h3>Order List</h3>
            <br>

            <table class="item-tbl">
                <tr>
                    <th>S.N.</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th colspan="3">Actions</th>
                </tr>
                <?php
                include '../dbcon/dbconnect.php';
                include '../login/login-check.php';
                $sql = "SELECT * from order_item as ot inner join item as i on ot.item_id = i.id inner join orders as o on o.order_id = ot.order_id where o.hascheckout = 0 and o.order_id = $oid ";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $sn = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $order_id = $row['order_id'];
                        $item_id = $row['id'];
                        $orderitemid = $row['order_item_id'];


                ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['price']; ?> </td>
                            <td><?php echo $row['qty']; ?> </td>

                            <td>
                                <form action="" method="post">
                                    <input type="number" name="quantity" min="1" max="100" value="<?php echo $row['qty'] ?>">
                                    <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
                            </td>
                            <td>
                                <input type="submit" name="update" value="Update">
                                </form>
                            </td>
                            <td>
                                <a href="../pages/delete-order.php?id=<?php echo $orderitemid; ?>" onclick="return confirmDel();">Remove</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr> <td colspans='6'> Nothing to display. </td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>