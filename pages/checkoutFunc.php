<?php
include '../dbcon/dbconnect.php';

if (isset($_POST['checkout'])) {
    $oid = $_POST['table_id'];
    echo $oid;
    // Sanitize input to prevent SQL injection
    $oid = mysqli_real_escape_string($conn, $oid);

    $checkoutSQL = "UPDATE orders SET hascheckout = '1' WHERE table_no = '$oid' AND hascheckout = '0'";
    $response = mysqli_query($conn, $checkoutSQL);

    if ($response) {
        // echo "DONE";
    } else {
        // Display error message if query fails
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "No checkout data received";
}
