<?php
require 'connect.php';


if (!isset($_GET['id'])) {
    die("Error: ID parameter is missing.");
}

$id = $_GET['id'];


$sql = "SELECT file_name FROM muticrud WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $file_path = "uploads/" . $row['file_name'];

   
    if (!empty($row['file_name']) && file_exists($file_path)) {
        unlink($file_path);
    }
}

$delete_sql = "DELETE FROM muticrud WHERE id = $id";

if ($conn->query($delete_sql) === TRUE) {
    echo "Record deleted successfully";
    header("Location: index.php"); 
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
