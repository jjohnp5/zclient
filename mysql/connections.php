<?php
$connect = mysqli_connect("localhost", "username", "passsword", "database");
if(mysqli_connect_error()){
    die("Database connection failed.");
}
 ?>
