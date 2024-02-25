<?php include '../login/login-check.php'; ?>
<?php
include '../dbcon/dbconnect.php';
if (isset($_GET['id'])) {
    $itemId = $_GET['id'];
    $sql = "SELECT * FROM `item` WHERE `id` = $itemId";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num > 0) {
        $row = mysqli_fetch_assoc($result);
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $image = $row['image'];
    } else {
        header("location: http://localhost/food-order-sys/pages/waiter_home.php");
    }
} else {
    header("location: http://localhost/food-order-sys/pages/waiter_home.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/orderpopup.css">
</head>

<body>
    <form action="" method="post">
        <fieldset>
            <legend>Selected Food</legend>
            <div class="food-menu-img">
                <img src="<?php echo $row['image'] ?>" alt="" height="200px" width="200px">
            </div>
            <div class="food-menu-desc">
                <h3><?php echo $title; ?></h3>
                <p class="food-price">Rs. <?php echo $price; ?></p>
                <div class="order-label">Quantity
                    <div class="quantity">
                        <button class="btn minus-btn disabled" type="button">-</button>
                        <input type="text" name="quantity" id="quantity" value="1" class="qty" readonly="true">
                        <button class="btn plus-btn" type="button">+</button>
                        <input type="submit" name="submit" id="" value="Confirm Order" class="submit-btn">
                        <input type="hidden" name="item_id" value="<?php echo $itemId; ?>">
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
    <script src="order.js"></script>
</body>

</html>
<?php
include '../dbcon/dbconnect.php';
if (isset($_POST['submit'])) {
    $item_id = $_POST['item_id'];
    $qty = $_POST['quantity'];
    $total = $qty * $price;

    $sql2 = "INSERT into order_tbl (`item_id`, `qty`, `total`) VALUES ($item_id, $qty, $total)";
    $result2 = mysqli_query($conn, $sql2);

    if ($result2 == true) {
        echo "<script>alert('Added to Order List')</script>";
    } else {
        echo "<script>alert('Something went wrong')</script>";
    }
}
?>