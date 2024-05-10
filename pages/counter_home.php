<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: lightgray;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 40px;
        }

        .wrapper {
            background-color: #fff;
            width: 250px;
            padding: 20px;
            height: 250px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .table-number {
            font-size: 24px;
            color: black;
            font-weight: bold;
            text-decoration: none;
            display: block;
            margin-top: 10px;
        }

        .table-number:hover {
            color: blue;
        }

        .table-number img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

    </style>
        <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">

</head>

<body>
<nav>
        <div class="left">
            <a href="../pages/kitchen_home.php">Online Food Ordering System</a>
        </div>
        <div class="right">
            <a href="../pages/kitchen_home.php">Home</a>
            <a href="../login//logout.php">Logout</a>
        </div>
    </nav>
    <div class="container">
        <?php

        include '../dbcon/dbconnect.php';
        include '../login/login-check.php';

        $sql = "SELECT * FROM no_table";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);

        if ($num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <!-- <a href="./orderlist.php?table_id=<?php echo $row['tbl_id']; ?>"> -->
                <a href="./counterorderlist.php?table_id=<?php echo $row['tbl_id']; ?>">

                    <div class="wrapper">
                        <img src="../image_item/table.png" alt="Chair Icon"> <br>
                        <span class="table-number"><?php echo $row['tbl_no']; ?></span>
                    </div>
                </a>
        <?php
            }
        } else {
        } ?>
    </div>
</body>

</html>