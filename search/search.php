<?php
include '../dbcon/dbconnect.php';
$searchQuery = $_POST['query'];

$searchsql = "SELECT * FROM item WHERE title LIKE '%$searchQuery%'";
$result = mysqli_query($conn, $searchsql);

if ($result->num_rows > 0) {  
    echo "
    <table class='item-tbl'>
    <tr>
    <th>S.N.</th>
    <th>Title</th>
    <th>Description</th>
    <th>Image</th>
    <th>Price</th>
    <th colspan='2'>Actions</th>
    <th></th>
    </tr>"; 
    $sn = 1;
    while ($row = $result->fetch_assoc()) {
        $id = $row['id']; 
        echo "<tr> 
           <td>".$sn++."</td>
           <td>".$row['title']."</td>
           <td>".$row['description']."</td>
           <td><img src='".$row['image']."' alt='Item Image' height='200px' width='200px'></td>
           <td>".$row['price']."</td>
           <td colspan='2' class='widi'><a href='../admin/update-food.php?id=".$row['id']."' class='btn-sec'>Update Item</a></td>
           <td colspan='2' class='widi'><a href='../admin/delete-food.php?id=".$row['id']."&image=".$row['image']."' onclick='return confirmDel();' class='btn-dan'>Delete Item</a></td>
           </tr>";
    }
    echo "</table>"; 
} else {
    echo 'No result Found';
}
?>

