<html>

<head>
    <title>Food </title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <?php include('nav.php');
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

    <!-- add footer here  -->
    <!-- <footer class="footer">
        <div class="containers">
            <div class="footer-content">
                <div class="footer-section about">
                    <h2>About Us</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vitae imperdiet ex. Sed vestibulum nulla eu odio cursus, at vestibulum lorem cursus.</p>
                    <div class="contact">
                        <span> 123-456-7890</span>
                        <span>hello@example.com</span>
                    </div>
                </div>
                <div class="footer-section contact-form">
                    <h2>Contact Us</h2>
                    <div class="socials">
                        <a href="www.facebook.com">Facebook</a>
                        <a href="www.instagram.com">Instagram</i></a>
                        <a href="www.linkedin.com">LinkedIn</i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; 2023 Online Food Ordering System | Designed by Diya
            </div>
        </div>
    </footer> -->
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