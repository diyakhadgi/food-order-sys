<?php
include '../dbcon/dbconnect.php';
session_start();
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <form action="" method="post">
        Username: <input type="text" name="username" id=""> <br><br>
        Password: <input type="password" name="password" id=""> <br><br>
        <input type="submit" name="login" value="Login" id="">
    </form>
    <a href="../register/register.php">Don't have an account?</a>
    </div>  
    <?php
      if (isset($_POST['login'])){
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num > 0)
        {
            $_SESSION['username'] = $username;
            header("location: http://localhost/food-order-sys/pages/display.php");
            exit();
        } else {
            echo "Login failed";
        }
    }
    ?> 
</body>
</html>