<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName1 = "login_register";  

$conn1 = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName1);
if (!$conn1) {
    die("Connection to login_register failed: " . mysqli_connect_error());
}
$dbName2 = "shop"; 
$conn2 = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName2);
if (!$conn2) {
    die("Connection to add_product failed: " . mysqli_connect_error());
}   
?>