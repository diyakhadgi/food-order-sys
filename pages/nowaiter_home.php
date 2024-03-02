<!DOCTYPE html>
<html>

<head>
    <title>Online Food Ordering System</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/item.css">
    <link rel="stylesheet" href="../css/orderpopup.css">

    <script>
        function openPopup(url) {
            var popup = document.getElementById("popup");
            popup.style.display = "block";

            var popupContent = document.getElementById("popupContent");
            popupContent.src = url;
        }

        function closePopup() {
            var popup = document.getElementById("popup");
            popup.style.display = "none";
        }
    </script>
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

    <!-- Hidden popup -->
    <div id="popup" class="popup">
        <button onclick="closePopup()">Close</button>
        <iframe id="popupContent" width="600" height="400" frameborder="0"></iframe>
    </div>

    <table class="item-tbl" align="center" style="margin-top: 2%;">
        <tr>
            <th>S.N.</th>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
            <th>Price</th>
            <th>Order Now</th>
        </tr>
        <?php
        include '../dbcon/dbconnect.php';
        // include '../login/login-check.php';
        // $tableno = $_GET['table_id'];
        // echo $tableno;
        $sql = "SELECT * FROM item";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $sn = 1;
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>
                        <img src="<?php echo $row['image'] ?>" alt="<?php echo "Image of " . $row['title'] ?>" class="item" height="200px" width="200px">
                    </td>
                    <td><?php echo 'Rs.' . $row['price']; ?></td>
                    <td class="widi">
                        <a href="#" class="btn-sec" onclick="openPopup('../pages/order_item.php?id=<?php echo $row['id']; ?>')">Order Item</a>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='6'>Food not added yet.</td></tr>";
        }
        ?>
    </table>

</body>

</html>