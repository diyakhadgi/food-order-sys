<html>
    <head>
        <title>Food </title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
    <?php include('nav.php');
    include '../dbcon/dbconnect.php';
    session_start();
    $profile = $_SESSION['username'];
    if($profile==true)
    {
    
    }
    else {
        header('location:http://localhost/food-order-sys/index.html');
    }
    ?>
    <div class="main-content">
        <div class="wrapper">
            <h3>DASHBOARD</h3>

            <div class="col-4">
                <h1>5</h1><br>
                Categories
            </div>

            <div class="col-4">
                <h1>5</h1><br>
                Categories
            </div>

            <div class="col-4">
                <h1>5</h1><br>
                Categories
            </div>

            <div class="col-4">
                <h1>5</h1><br>
                Categories
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <!-- add footer here  -->
    </body>
</html>