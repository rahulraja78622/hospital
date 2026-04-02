<?php
session_start();
include 'db.php';

// Agar login nahi hai to login page pe bhejo
if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hospital Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <!-- Header Start -->
    <div class="header">
        <div class="left">
            <img src="/hospital/image/download.jpg" class="logo">
            <h2>Hospital Admin Panel</h2>
        </div>

        <div class="right">
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>
    <!-- Header End -->

    <br>

    <a href="add.php" class="add-btn">Add Patient</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Disease</th>
            <th>Action</th>
        </tr>

        <?php
        $result = $conn->query("SELECT * FROM patients");

        while($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['age'] ?></td>
            <td><?= $row['gender'] ?></td>
            <td><?= $row['disease'] ?></td>
            <td>
                <a class="edit" href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                <a class="delete" href="delete.php?id=<?= $row['id'] ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>