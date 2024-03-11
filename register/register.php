<?php
include '../dbcon/dbconnect.php';

session_start();

// Check if the user is already logged in, redirect to the display page
if (isset($_SESSION['id'])) {
    header('location:http://localhost/food-order-sys/pages/index.php');
    exit();
}

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $email = $_POST['email'];
    $role = $_POST['role'];

    $query = "INSERT INTO staff (`username`, `name`, `email`, `password`, `isadmin`,`usertype`) VALUES ('$username', '$name', '$email', '$password','0', '$role')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header('location:http://localhost/food-order-sys/login/login.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="../css/register.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="register">
    <form action="" method="post">
        Full Name: <input type="text" name="name" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        User Type:
        <select name="role" required>
            <option value="KITCHEN">Kitchen</option>
            <option value="WAITER">Waiter</option>
            <option value="COUNTER">Counter</option>
        </select><br><br>
        <button type="submit" name="register">Register</button>
    </form>
    </div>
</body>
</html>