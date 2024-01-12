<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body>
    <!-- nav bar -->
    <nav>
      <div class="left">
        <a href="#">Online Food Ordering System</a>
      </div>
      <div class="right">
        <a href="#">Home</a>
        <a href="#">Categories</a>
        <a href="#">Food</a>
        <a href="#">Contact</a>
        <a href="../login/logout.php">Logout</a>
      </div>
    </nav>

    <!--  food search bar-->
    <section class="food-search">
      <div class="container">
        <form action="" method="post">
          <input type="search" name="search" placeholder="Search for food.." id="" class="search-bar">
          <input type="submit" name="" value="Search" id="" class="btn btn-primary">
        </form>
      </div>
    </section>

<?php
include '../dbcon/dbconnect.php';
session_start();
$profile = $_SESSION['username'];
if($profile==true)
{

}
else {
    header('location:http://localhost/food-order-sys/index.html');
}
$sql = "SELECT * FROM users where username = '$profile'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo "Welcome " .$row['name'];
?>

  </body>
</html>
