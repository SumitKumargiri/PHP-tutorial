<form action="add.php" method="post" enctype="multipart/form-data">
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

    <label>Upload File (Image or PDF):</label><br>
    <input type="file" name="file" required><br><br>

    <button type="submit" name="submit">Add Record</button>
</form>


<?php
require 'connect.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $hobbies = $_POST['hobbies'];
    $gender = $_POST['gender'];
    $status = isset($_POST['status']) ? 'Active' : 'Inactive';

    // Handle file upload
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = pathinfo($file_name, PATHINFO_EXTENSION);
    
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file_name);

    // Allow only images and PDFs
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
    if (in_array(strtolower($file_type), $allowed_types)) {
        move_uploaded_file($file_tmp, $target_file);
    } else {
        echo "Invalid file type. Only JPG, PNG, GIF, and PDF are allowed.";
        exit();
    }

    $sql = "INSERT INTO muticrud (name, email, hobbies, gender, status, file_name, file_type) 
            VALUES ('$name', '$email', '$hobbies', '$gender', '$status', '$file_name', '$file_type')";

    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully";
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
