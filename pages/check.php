<?php
include '../dbcon/dbconnect.php';

// Query to check for new entries
$sql = "SELECT COUNT(*) AS count FROM orders WHERE order_date > NOW() - INTERVAL 5 SECOND";
$result = $conn->query($sql);

if ($result === false) {
    // Handle query error
    echo "Query error: " . $conn->error;
} else {
    $row = $result->fetch_assoc();
    $count = $row['count'];
    if ($count > 0) { 
        echo 'true';
    } else {
        echo 'false';
    }
}

$conn->close();
?>
