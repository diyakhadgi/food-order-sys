<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container {
            width: auto;
            height: 1000px;
            background: pink;
            display: flex;
            gap: 20px;
            padding: 40px;
        }

        .wrapper {
            background-color: whitesmoke;
            width: 500px;
            padding: 20px;
            height: 500px;
            text-align: center;
            margin: 0 auto;
        }
    </style>
</head>

<body>
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
                <a href="./orderlist.php?table_id=<?php echo $row['tbl_id']; ?>">
                    <div class="wrapper">
                        <?php echo $row['tbl_no']; ?>
                    </div>
                </a>
        <?php
            }
        } else {
        } ?>
    </div>
</body>

</html>