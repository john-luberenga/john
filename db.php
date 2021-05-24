<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "john";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


error_reporting(0);
?>

