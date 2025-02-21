<?php
$servername = "localhost";
$username = "maaz"; 
$password = "maaz@123"; 
$dbname = "lms"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "db connected";
?>