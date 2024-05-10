<html>

<head>
    <title>Food </title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
<nav>
    <div class="left">
        <a href="../admin/display.php">Online Food Ordering System</a>
    </div>
    <div class="right">
        <a href="../admin/display.php">Home</a>
        <div class="food">
          <a href="manage-food.php">Food</a>
        </div>
        <a href="../login/logout.php">Logout</a>
    </div>
</nav>
    <?php
    include '../dbcon/dbconnect.php';
    include '../login/login-check.php';
    ?>
    <div class="main-content">
        <div class="wrapper">
            <h3>DASHBOARD</h3>

            <div class="col-4">
                <?php
                $sql = "SELECT * FROM staff WHERE isadmin = 1 ";
                $res = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($res);
                ?>
                <h1><?php echo $num ?></h1><br>
                Admins
            </div>

            <div class="col-4">
                <?php
                $sql = "SELECT * FROM staff WHERE isadmin = 0 AND usertype = 'WAITER' ";
                $res = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($res);
                ?>
                <h1><?php echo $num ?></h1><br>
                Waiters
            </div>

            <div class="col-4">
                <?php
                $sql = "SELECT * FROM staff WHERE isadmin = 0 AND usertype = 'KITCHEN'";
                $res = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($res);
                ?>
                <h1><?php echo $num ?></h1> <br>
                Kitchen Staff
            </div>

            <div class="col-4">
                <?php
                $sql = "SELECT * FROM staff WHERE isadmin = 0 AND usertype = 'COUNTER'";
                $res = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($res);
                ?>
                <h1><?php echo $num ?></h1> <br>
                Counter Staff
            </div>

            <div class="clearfix"></div>
        </div>
    </div>

    <style>
        .footer {
            margin-top: auto 190px;
            background-color: #211b1b;
            color: #fff;
            padding: 20px 0;
        }

        .containers {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* .footer-content {
            display: flex;
            flex-wrap: wrap;
        } */

        .footer-section {
            /* flex: 1; */
            margin-bottom: 20px;
        }

        .footer-section h2 {
            margin-bottom: 15px;
        }

        .contact span {
            display: block;
            margin-bottom: 10px;
        }

        .socials a {
            color: #fff;
            margin-right: 10px;
            text-decoration: none;
        }

        .links ul {
            list-style: none;
            padding: 0;
        }

        .links ul li {
            margin-bottom: 10px;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 10px;
            border-top: 1px solid #666;
        }
    </style>
</body>

</html>