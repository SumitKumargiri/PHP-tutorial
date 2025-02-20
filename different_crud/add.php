<?php
echo "Add Page";
require 'connect.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $hobbies = $_POST['hobbies'];
    $gender = $_POST['gender'];
    $status = isset($_POST['status']) ? 'Active' : 'Inactive'; 

    $sql = "INSERT INTO muticrud (name, email, hobbies, gender, status) 
            VALUES ('$name', '$email', '$hobbies', '$gender', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully";
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Record</title>
    <style>
        .form-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Add Record</h2>
    <form action="add.php" method="post">
        <input type="text" name="name" placeholder="Enter Name" required><br><br>
        <input type="email" name="email" placeholder="Enter Email" required><br><br>

        <label>Hobbies:</label><br>
        <select name="hobbies" required>
            <option value="Reading">Reading</option>
            <option value="Music">Music</option>
            <option value="Sports">Sports</option>
            <option value="Traveling">Traveling</option>
        </select><br><br>

        <label>Gender:</label><br>
        <input type="radio" name="gender" value="Male" required> Male
        <input type="radio" name="gender" value="Female" required> Female
        <input type="radio" name="gender" value="Other" required> Other<br><br>

        <label>Status:</label><br>
        <input type="checkbox" name="status" value="Active"> Active<br><br>

        <button type="submit" name="submit">Add Record</button>
    </form>
</div>

</body>
</html>
