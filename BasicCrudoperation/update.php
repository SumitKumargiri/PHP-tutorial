<?php
require 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM crud WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Record not found!";
        exit();
    }
}

// Update logic
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $country = $_POST['country'];

    $updateSql = "UPDATE crud SET name='$name', email='$email', country='$country' WHERE id=$id";
    
    if ($conn->query($updateSql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
</head>
<body>
    <h2>Update Record</h2>
    <form action="update.php?id=<?php echo $id; ?>" method="post">
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>
        <input type="text" name="country" value="<?php echo $row['country']; ?>" required><br>
        <button type="submit" name="update">Update Record</button>
    </form>
</body>
</html>
