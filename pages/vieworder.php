<?php
$oid = $_GET['order_id'];
session_start();
$type = $_SESSION['usertype'];
$profile = $_SESSION['id'];
if (!$profile) {
    header("location: http://localhost/food-order-sys/pages/index.php");
    exit();
}

include '../dbcon/dbconnect.php';
// Process form submission for WAITER
if ($type == "WAITER" && isset($_POST['update'])) {
    $newqty = $_POST['quantity'];
    $item_id = $_POST['item_id'];
    $sql3 = "SELECT price FROM item WHERE id = $item_id";
    $priceres = mysqli_query($conn, $sql3);
    if ($priceres && mysqli_num_rows($priceres) > 0) {
        $price_row = mysqli_fetch_assoc($priceres);
        $price = $price_row['price'];
        $tot = $newqty * $price;
    }
    $sql2 = "UPDATE order_item AS ot
             INNER JOIN orders AS o ON o.order_id = ot.order_id
             SET ot.qty = '$newqty', ot.total = '$tot'
             WHERE ot.order_id = '$oid' AND o.hascheckout = 0 AND ot.item_id = '$item_id'";
    $res = mysqli_query($conn, $sql2);

    if ($res) {
        // echo "Updated";
    } else {
        echo "Not updated";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Food Ordering System</title>
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/item.css?v=<?php echo time(); ?>">
</head>

<body>
    <nav>
        <div class="left">
            <a href="../pages/waiter_home.php">Online Food Ordering System</a>
        </div>
        <div class="right">
            <a href="../pages/waiter_home.php">Home</a>
            <!-- <a href="../pages/orderlist.php">Order List</a> -->
            <!-- <a href="../register/register.php">Checkout</a> -->
            <a href="#">Contact</a>
            <a href="../login/logout.php">Logout</a>
        </div>
    </nav>

    <div class="main-content">
        <div class="wrapper">
            <br>
            <h3>Order List</h3>
            <?php
            if ($type == "KITCHEN") { ?>
                <form method="POST">
                    <input type="submit" name="placeOrder" id="" value="Place Order" <?php if ($type == "KITCHEN") {
                                                                                            echo 'hidden';
                                                                                        } ?>>
                </form>
                <?php
                if (isset($_POST['placeOrder'])) {
                    $hasserve = $_POST['hasServe'];
                }
                ?>
            <?php } else if ($type == "WAITER") {
            ?>
                <!-- <form action="" method="post">
                    <input type="submit" name="confirm" id="" value="Confirm Order">
                </form> -->
            <?php
            }
            ?>
            <br>

            <table class="item-tbl" border="1">
                <tr>
                    <th>S.N.</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <?php
                    if ($type != "KITCHEN") {
                    ?>

                        <th>Update Quantity</th>
                    <?php
                    }
                    ?>
                    <th colspan="3">Action</th>
                </tr>
                <?php
                include '../dbcon/dbconnect.php';

                $sql = "SELECT * from order_item as ot inner join item as i on ot.item_id = i.id inner join orders as o on o.order_id = ot.order_id where o.hascheckout = 0 and o.order_id = $oid ";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $sn = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $order_id = $row['order_id'];

                        $item_id = $row['item_id'];
                        $orderitemid = $row['order_item_id'];
                        $checkserved = $row['hasServed'];

                ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['price']; ?> </td>
                            <td><?php echo $row['qty']; ?> </td>

                            <?php
                            $sql4 = "SELECT hasServed from order_item where order_item_id = $orderitemid";
                            $sqlres = mysqli_query($conn, $sql4);
                            if ($sqlres && mysqli_num_rows($sqlres) > 0) {
                                $roww = mysqli_fetch_assoc($sqlres);
                                $hasserved = $roww['hasServed'];
                                if ($hasserved == 0) {
                                    $hasserved = "Order Pending";
                                } else if ($hasserved == 1) {
                                    $hasserved = "Order Placed";
                                }
                            }
                            if ($type == "KITCHEN") {
                            ?>

                                <td> <?php if ($type == "KITCHEN") {

                                        ?> <select name="hasServe" id="">
                                            <option value="" disabled selected>Select option</option>
                                            <option value="ready">Ready</option>
                                        </select> <?php } ?> </td>
                            <?php
                            } else {
                            ?>
                                <td><?php echo $hasserved ?></td>
                            <?php
                            }
                            ?>
                            <?php
                            if ($type != "KITCHEN") {
                            ?>


                                <td>
                                    <form action="" method="post">
                                        <input type="number" name="quantity" min="1" max="100" value="<?php echo $row['qty']; ?>" <?php if ($type == "KITCHEN") {
                                                                                                                                        echo 'hidden';
                                                                                                                                    } else if ($hasserved == "Order Placed") {
                                                                                                                                        echo 'disabled';
                                                                                                                                    } ?>>
                                        <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
                                    </form>
                                </td>

                            <?php
                            }
                            ?>
                            <td>

                                <form action="placeorder.php?order_id=<?php echo $_GET['order_id']; ?>" method="post">
                                    <input type="hidden" name="foodid" value="<?php echo $item_id; ?>">
                                    <button type="submit" class="update-btn" name="update" value="<?php echo $item_id;
                                                                                                    ?>">UPDATE</button>
                                </form>
                                </form>
                            </td>
                            <td>
                                <a href="../pages/delete-order.php?id=<?php echo $orderitemid; ?>" onclick="return confirmDel();" class="del-btn" <?php if ($type == "KITCHEN") {
                                                                                                                                                        echo 'hidden';
                                                                                                                                                    } ?>>Remove</a>
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
    <?php
    if (isset($_POST['confirm'])) {
        // echo $order_id;
        $message = "Order confirmed successfully.";
        echo "<script>alert('$message');</script>";
    }
    ?>
    <script>
        function confirmDel() {
            return confirm("Are you sure you want to delete the order?");
        }
    </script>
</body>

</html>