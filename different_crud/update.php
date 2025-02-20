<?php
require 'connect.php';

// Check if updating
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $hobbies = $_POST['hobbies'];
    $gender = $_POST['gender'];
    $status = isset($_POST['status']) ? 'Active' : 'Inactive';

    $sql = "UPDATE muticrud SET name='$name', email='$email', hobbies='$hobbies', gender='$gender', status='$status' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Check if editing
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM muticrud WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
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
    <h2><?php echo isset($row) ? "Edit Record" : "Add Record"; ?></h2>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo isset($row) ? $row['id'] : ''; ?>">
        <input type="text" name="name" placeholder="Enter Name" value="<?php echo isset($row) ? $row['name'] : ''; ?>" required><br><br>
        <input type="email" name="email" placeholder="Enter Email" value="<?php echo isset($row) ? $row['email'] : ''; ?>" required><br><br>
        
        <label>Hobbies:</label><br>
        <select name="hobbies" required>
            <option value="Reading" <?php if(isset($row) && $row['hobbies'] == 'Reading') echo 'selected'; ?>>Reading</option>
            <option value="Music" <?php if(isset($row) && $row['hobbies'] == 'Music') echo 'selected'; ?>>Music</option>
            <option value="Sports" <?php if(isset($row) && $row['hobbies'] == 'Sports') echo 'selected'; ?>>Sports</option>
            <option value="Traveling" <?php if(isset($row) && $row['hobbies'] == 'Traveling') echo 'selected'; ?>>Traveling</option>
        </select><br><br>

        <label>Gender:</label><br>
        <input type="radio" name="gender" value="Male" <?php if(isset($row) && $row['gender'] == 'Male') echo 'checked'; ?>> Male
        <input type="radio" name="gender" value="Female" <?php if(isset($row) && $row['gender'] == 'Female') echo 'checked'; ?>> Female
        <input type="radio" name="gender" value="Other" <?php if(isset($row) && $row['gender'] == 'Other') echo 'checked'; ?>> Other<br><br>

        <label>Status:</label><br>
        <input type="checkbox" name="status" value="Active" <?php if(isset($row) && $row['status'] == 'Active') echo 'checked'; ?>> Active<br><br>

        <button type="submit" name="<?php echo isset($row) ? 'update' : 'submit'; ?>">
            <?php echo isset($row) ? 'Update Record' : 'Add Record'; ?>
        </button>
    </form>
</div>

</body>
</html>
