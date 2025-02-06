<?php
 echo "add page";
 require 'connect.php';

 if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $country = $_POST['country'];

    $sql = "insert into crud(name,email,country) values('$name','$email','$country')";

    if($conn->query($sql)===true){
        echo "Recorded added successfully";
        header("Location: index.php");
        exit();
    }
    else{
        echo "Error";
    }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="form-container">
        <form action="add.php" method="post">
            <input type="text" name="name" placeholder="Enter Name" required><br>
            <input type="email" name="email" placeholder="Enter Email" required><br>
            <input type="text" name="country" placeholder="Enter Country" required><br>
            <button type="submit" name="submit">Add Record</button>
        </form>
    </div>
</body>
</html>