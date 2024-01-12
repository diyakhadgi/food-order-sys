<?php
session_start();
session_unset();
session_destroy();
header("location:http://localhost/food-order-sys/index.html");

?>