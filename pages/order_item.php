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
    <form action="">
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
                        <input type="text" name="" id="quantity" value="1" class="qty" disabled="disabled">
                        <button class="btn plus-btn" type="button">+</button>
                        <input type="submit" name="submit" id="" value="Add to Order List" class="submit-btn">
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
    <script src="order.js"></script>
</body>
</html>
<?php

?>