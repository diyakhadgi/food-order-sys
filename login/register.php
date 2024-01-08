<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
</head>
<body>
    <form action="" method="post">
        Email: <input type="email" name="email" id=""> <br><br>
        Username: <input type="text" name="username" id=""> <br><br>
        Password: <input type="password" name="password" id=""> <br><br>
        Confirm Password: <input type="password" name="cpassword" id=""> <br><br>
        <input type="submit" name="register" value="Register" id="">
    </form>

    <?php
    include '../dbcon/dbconnect.php';
    if(isset($_POST['register']))
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $cpassword = md5($_POST['cpassword']);
        $email = $_POST['email'];

        // validating username
        $query = "SELECT * FROM users WHERE username = '$username'";
        $user_result = mysqli_query($conn, $query); 

        $num_rows = mysqli_num_rows($user_result);

        if ($num_rows > 0) {
            echo "<br>";
            echo "Username already taken";
        } else {
            // check if password matches

            if ($password == $cpassword) {
                $sql = "INSERT INTO `users` (`username`, `password`, `email`) VALUES ('$username', '$password', '$email')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    ?>
                    <br>
                    <?php
                    echo "Account created successfully";
                    header("location:http://localhost/food-order-sys/login/login.php");
                } else {
                    ?>
                    <br>
                    <?php
                    echo "Something went wrong";
                }
            } else {
                echo "<br>";
                echo "Password doesn't match";
            }
        }
    }
    ?>
</body>
</html>