<?php
// Include the database connection file
include '../dbcon/dbconnect.php';

// Start the session
session_start();

// Check if the user is already logged in, redirect to the display page
if (isset($_SESSION['id'])) {
    header('location:http://localhost/food-order-sys/pages/display.php');
    exit();
}

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Note: Consider using more secure password hashing methods
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Perform database insertion based on the selected role
    if ($role == 'admin') {
        $query = "INSERT INTO users (`username`, `name`, `email`, `password`, `isadmin`) VALUES ('$username', '$name', '$email', '$password', 1)";
    } elseif ($role == 'user') {
        $query = "INSERT INTO customer (`username`, `name`, `email`, `password`) VALUES ('$username', '$name', '$email', '$password')";
    }

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
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
</head>

<body>
    <form action="" method="post">
        Full Name: <input type="text" name="name" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        User Type:
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select><br><br>
        <input type="submit" name="register" value="Register">
    </form>
</body>
</html>
