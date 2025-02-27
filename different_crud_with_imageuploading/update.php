<?php
require 'connect.php';


if (!isset($_GET['id'])) {
    die("Error: ID parameter is missing.");
}

$id = $_GET['id'];


$sql = "SELECT * FROM muticrud WHERE id = $id";
$result = $conn->query($sql);


if (!$result || $result->num_rows == 0) {
    die("Error: Record not found.");
}

$row = $result->fetch_assoc();
?>

<h2>Update Record</h2>
<form action="update.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
    <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br><br>
    <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>

    <label>Hobbies:</label><br>
    <select name="hobbies" required>
        <option value="Reading" <?php if ($row['hobbies'] == "Reading") echo "selected"; ?>>Reading</option>
        <option value="Music" <?php if ($row['hobbies'] == "Music") echo "selected"; ?>>Music</option>
        <option value="Sports" <?php if ($row['hobbies'] == "Sports") echo "selected"; ?>>Sports</option>
        <option value="Traveling" <?php if ($row['hobbies'] == "Traveling") echo "selected"; ?>>Traveling</option>
    </select><br><br>

    <label>Gender:</label><br>
    <input type="radio" name="gender" value="Male" <?php if ($row['gender'] == "Male") echo "checked"; ?>> Male
    <input type="radio" name="gender" value="Female" <?php if ($row['gender'] == "Female") echo "checked"; ?>> Female
    <input type="radio" name="gender" value="Other" <?php if ($row['gender'] == "Other") echo "checked"; ?>> Other<br><br>

    <label>Status:</label><br>
    <input type="checkbox" name="status" value="Active" <?php if ($row['status'] == "Active") echo "checked"; ?>> Active<br><br>

    <label>Current File:</label><br>
    <?php if (!empty($row['file_name'])): ?>
        <?php if (in_array($row['file_type'], ['jpg', 'jpeg', 'png', 'gif'])): ?>
            <img src="uploads/<?php echo $row['file_name']; ?>" width="50">
        <?php elseif ($row['file_type'] == 'pdf'): ?>
            <a href="uploads/<?php echo $row['file_name']; ?>" target="_blank">View PDF</a>
        <?php endif; ?>
    <?php else: ?>
        No file uploaded.
    <?php endif; ?>
    <br><br>

    <label>Upload New File (optional):</label><br>
    <input type="file" name="file"><br><br>

    <button type="submit" name="update">Update Record</button>
</form>

<?php

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $hobbies = $_POST['hobbies'];
    $gender = $_POST['gender'];
    $status = isset($_POST['status']) ? 'Active' : 'Inactive';


    $file_name = $row['file_name']; 
    $file_type = $row['file_type'];

    if (!empty($_FILES['file']['name'])) {
        $new_file_name = $_FILES['file']['name'];
        $file_ext = pathinfo($new_file_name, PATHINFO_EXTENSION);
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($new_file_name);
        
        if (!empty($row['file_name']) && file_exists("uploads/" . $row['file_name'])) {
            unlink("uploads/" . $row['file_name']);
        }

        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
        $file_name = $new_file_name;
        $file_type = $file_ext;
    }

    $update_sql = "UPDATE muticrud SET name='$name', email='$email', hobbies='$hobbies', gender='$gender', status='$status', file_name='$file_name', file_type='$file_type' WHERE id=$id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
