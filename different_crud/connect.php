<?php
$host = "localhost";
$user = "root"; 
$pass = "Sumit@123"; 
$dbname = "crudoperation";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
