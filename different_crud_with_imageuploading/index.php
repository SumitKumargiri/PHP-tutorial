<?php
require 'connect.php';
$sql = "SELECT * FROM muticrud";
$result = $conn->query($sql);
?>

<a href="add.php">Add</a>
<table border="1">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Hobbies</th>
        <th>Gender</th>
        <th>Status</th>
        <th>File</th>
        <th>Action</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['hobbies']; ?></td>
            <td><?php echo $row['gender']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <?php
                $file_path = "uploads/" . $row['file_name'];
                $file_type = $row['file_type'];

                if (in_array($file_type, ['jpg', 'jpeg', 'png', 'gif'])) {
                    echo "<img src='$file_path' width='50' height='50'>";
                } elseif ($file_type == 'pdf') {
                    echo "<a href='$file_path' target='_blank'>View PDF</a>";
                } else {
                    echo "No file";
                }
                ?>
            </td>
            <td>
                <a href="update.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
