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
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="login">
    <form action="" method="post">
        <h1>LOG IN</h1>
        <label for="username">Username:</label>
            <input type="text" name="username" id="username" required> 
        <label for="password"> Password:</label>
             <input type="password" name="password" id="" required>
        <button type="submit" name="login">Login</button>
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
                session_start();
                $user_id = $row["id"]; 
                $usertype = $row["usertype"];
                $_SESSION['usertype'] = $usertype;
                $isadmin = $row["isadmin"];
                if($isadmin == 1) {
                    $_SESSION['id'] = $user_id; 
                    header("location: ../admin/display.php");
                    exit();
                } else {
                    switch ($usertype) {
                        case "KITCHEN":
                            $_SESSION['id'] = $user_id; 
                            header("location: ../pages/kitchen_home.php");
                            exit();
                            break;
                        case "WAITER":
                            $_SESSION['id'] = $user_id; 
                            header("location: ../pages/waiter_home.php");
                            exit();
                            break;
                        case "COUNTER":
                            $_SESSION['id'] = $user_id; 
                            header("location: ../pages/counter_home.php");
                            exit();
                            break;
                        default:
                            echo "Invalid user type";
                    }
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
