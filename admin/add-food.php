<?php
include '../dbcon/dbconnect.php';
include '../login/login-check.php';
include '../admin/nav.php';
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="tbl-30">
                <table>
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" id="" placeholder="Title of the food">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" id="">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image" id="">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" id="" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
                </table>
            </div>
        </form>
    </div>
</div>