        <?php
        $oid = $_GET['table_id'];
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
            <link rel="stylesheet" href="../css/counter.css">
            <link rel="stylesheet" href="../css/admin.css">
            <link rel="stylesheet" href="../css/style.css">
            <link rel="stylesheet" href="../css/item.css">

        </head>

        <body>
            <nav>
                <div class="left">
                    <a href="../pages/waiter_home.php">Online Food Ordering System</a>
                </div>
                <div class="right">
                    <a href="../pages/waiter_home.php">Home</a>
                    <a href="../login/logout.php">Logout</a>
                </div>
            </nav>

            <div class="main-content">
                <div class="wrapper">
                    <br>
                    <h3>Order List</h3>
                    <br>
                    <!-- <button onclick="window.print()">print</button> -->

                    <table>
                        <tr>
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                        <form action="checkoutFunc.php" method="POST">
                            <?php
                            include '../dbcon/dbconnect.php';
                            include '../login/login-check.php';
                            $grandTotal = 0;
                            $sql = "SELECT * FROM order_item AS ot INNER JOIN item AS i ON ot.item_id = i.id INNER JOIN orders AS o ON o.order_id = ot.order_id WHERE o.hascheckout = 0 AND o.table_no = '$oid'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                $sn = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $order_id = $row['order_id'];
                                    $item_id = $row['id'];
                                    $orderitemid = $row['order_item_id'];
                                    $itemPrice = $row['price'];
                                    $itemQuantity = $row['qty'];
                                    $itemTotal = $itemPrice * $itemQuantity;
                                    $grandTotal += $itemTotal;
                            ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $row['title']; ?></td>
                                        <td><?php echo $row['price']; ?></td>
                                        <td><?php echo $row['qty']; ?></td>
                                        <td><?php echo $itemTotal; ?></td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr> <td colspan='6'> <p>Nothing to display.</p> </td></tr>";
                            }
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td bgcolor="#DEDEDE">Grand Total:</td>
                                <td bgcolor="#DEDEDE"><?php echo $grandTotal; ?></td> 
                            </tr>
                            <input type="hidden" name="table_id" value="<?php echo $oid; ?>">
                            <button type="submit" name="checkout">Checkout</button> &nbsp;
                            <!-- <button type="submit" name="checkout" onclick="window.print()">Generate Bill</button> -->
                        </form>

                    </table>
                </div>
            </div>
        </body>

        </html>