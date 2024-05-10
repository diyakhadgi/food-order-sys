<?php
session_start();
session_unset();
session_destroy();
?>

<script>
if (confirm("Are you sure you want to log out?")) {
    window.location.href = "http://localhost/food-order-sys/login/login.php";
} else {

}
</script>
