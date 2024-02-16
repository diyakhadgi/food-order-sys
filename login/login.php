<?php
include '../dbcon/dbconnect.php';
session_start();
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        $sql = "SELECT * FROM staff WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $usertype = $row["usertype"];
                switch ($usertype) {
                    case "KITCHEN":
                        $_SESSION['username'] = $username;
                        header("location: http://localhost/food-order-sys/pages/display.php");
                        exit();
                        break;
                    case "WAITER":
                        $_SESSION['username'] = $username;
                        header("location: ../pages/waiter_home.php");
                        exit();
                        break;
                    case "COUNTER":
                        $_SESSION['username'] = $username;
                        header("location: ../pages/counter_home.php");
                        exit();
                        break;
                    default:
                        echo "Invalid user type";
                }
            } else {
                echo "Invalid username or password";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    ?>
</body>
</html>
