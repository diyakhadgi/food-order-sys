<?php
include '../dbcon/dbconnect.php';

// Start session
session_start();

// Fetch the table number
$tableNo = $_GET['table_id'];

// Check if the order ID is already stored in the session
if (!isset($_SESSION['order_id'])) {
    // Fetch order details for the given table number
    $fetchorderid = "SELECT * FROM orders WHERE table_no = $tableNo AND hascheckout = 0";
    $res = mysqli_query($conn, $fetchorderid);
    if ($res) {
        // Check if an order exists for the table number
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            // Store the order ID in the session
            $_SESSION['order_id'] = $row['order_id'];
        } else {
            // If no order exists, create a new order and store its ID in the session
            $insertorderid = "INSERT INTO orders (table_no, hascheckout) VALUES ($tableNo, 0)";
            $result = mysqli_query($conn, $insertorderid);
            if ($result) {
                $_SESSION['order_id'] = mysqli_insert_id($conn); // Get the inserted order ID
            } else {
                echo "Error: " . mysqli_error($conn);
            }
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
            <!-- <a href="../pages/orderlist.php">Order List</a> -->
            <!-- <a href="../register/register.php">Checkout</a> -->
            <a href="#">Contact</a>
            <a href="../login//logout.php">Logout</a>
        </div>
    </nav>

    <div class="main-content">
        <div class="wrapper">
            <br>
            <h3>Order List</h3> <br>

            <table class="item-tbl" border="1">
                <tr>
                    <th>S.N.</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>image</th>
                    <th>quantity</th>
                    <th>order</th>
                </tr>
                <form action="" method="post">

                    <?php
                    $profile = $_SESSION['id'];
                    // Fetch items from the database
                    $sql = "SELECT * FROM item";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        $sn = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['price']; ?> </td>
                                <td><img src="<?php echo $row['image'] ?>" alt="" srcset="" height="200px" width="200px"></td>
                                <td>
                                    <div class="quantity">
                                        Quantity<input type="number" min="1" max="100" name="quantity[<?php echo $row['id']; ?>]" value="1">
                                    </div>
                                </td>
                                <td>
                                    Order now
                                    <input type="checkbox" name="ordercheckbox[]" value="<?php echo $row['id'] ?>">
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr> <td colspans='6'> Nothing to display. </td></tr>";
                    }
                    ?>
                    <button name="finalizeorder" type="submit">Order Now</button>
                    <a href="vieworder.php?order_id=<?php echo $_SESSION['order_id'] ?>">View Order</a>
                </form>
            </table>
            <?php
            // Check if the finalizeorder button is clicked
            if (isset($_POST['finalizeorder'])) {
                // Get the order ID from the session
                $orderid = $_SESSION['order_id'];
                if ($orderid) {
                    echo 'orderID: ' . $orderid . '<br>';

                    $orderitemlist = $_POST['ordercheckbox'];
                    print_r($orderitemlist);
                    $quantity = $_POST['quantity'];
                    print_r($quantity);
                    foreach ($orderitemlist as $itemId) {
                        echo 'Item id: ' . $itemId . '<br>';
                        $orderQuantity = $quantity[$itemId];
                        echo 'Order quantity: ' . $orderQuantity . '<br>';
                        // Insert order items into order_item table
                        $price = "SELECT price from item where id = $itemId";
                        $result = mysqli_query($conn, $price);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            if ($row) {
                                $price = $row['price'];
                                echo $price . '<br>';
                                $totalPrice = $orderQuantity * $price;
                                echo $totalPrice . '<br>';
                            }
                            $insertordersql = "INSERT INTO order_item (`order_id`, item_id, user_id, qty, total) VALUES ('$orderid','$itemId',' $profile',$orderQuantity,'$totalPrice')";
                            echo $insertordersql;
                            $res = mysqli_query($conn, $insertordersql);

                            if ($res) {
                                echo "Inserted successfully";
                            } else {
                                echo "Error: " . mysqli_error($conn);
                            }
                        }
                    }
                    // Process order items
                }
            }
            unset($_SESSION['order_id']);
            ?>
        </div>
    </div>
</body>

</html>