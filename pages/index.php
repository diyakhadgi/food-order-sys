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
      <a href="index.php">Online Food Ordering System</a>
    </div>
    <div class="right">
      <a href="../pages/index.php">Home</a>
      <a href="../login/login.php">Login</a>
      <a href="../register/register.php">Register</a>
      <a href="#">Contact</a>
    </div>
  </nav>

  <!--  food search bar-->
  <section class="food-search">
    <div class="container">
      <form action="" method="post">
        <input type="search" name="search" placeholder="Search for food.." id="" class="search-bar" />
        <input type="submit" name="" value="Search" id="" class="btn btn-primary" />
      </form>
    </div>
  </section>

  <div class="food-menu">
    <div class="container">
      <h2 class="text-center">Food Menu</h2>
      <?php
      include '../dbcon/dbconnect.php';
      $sql = "SELECT * FROM item";
      $result = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($result);
      if ($num > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $id = $row['id'];
          $title = $row['title'];
          $description = $row['description'];
          $price = $row['price'];
          $image = $row['image'];
      ?>
          <div class="menu">
            <div class="food-menu-box">
              <div class="food-menu-img">
                <img src="<?php echo $row['image'] ?>" alt="<?php echo "Image of " . $row['title'] ?>" class="item" height="200px" width="200px">
              </div>
              <div class="food-menu-desc">
                <h4><?php echo $row['title']; ?></h4>
                <p class="food-price">Rs. <?php echo $row['price']; ?></p>
                <p class="food-detail">
                  <?php echo $row['description']; ?>
                </p>

                <br>
                <a href="../login/login.php">Order Now</a>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        echo "Food not available";
      }
      ?>
</body>

</html>