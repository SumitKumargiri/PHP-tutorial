<?php
$servername = "localhost"; 
$username = "root"; 
$password = "Sumit@123";
$database = "crudoperation"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

// $conn->close();
?>
