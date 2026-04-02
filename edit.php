<?php
include 'db.php';

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM patients WHERE id=$id")->fetch_assoc();

if(isset($_POST['update'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $disease = $_POST['disease'];

    $conn->query("UPDATE patients SET 
        name='$name', age='$age', gender='$gender', disease='$disease'
        WHERE id=$id");

    header("Location: index.php");
}
?>

<form method="POST">
    Name: <input type="text" name="name" value="<?= $data['name'] ?>"><br>
    Age: <input type="number" name="age" value="<?= $data['age'] ?>"><br>
    Gender: <input type="text" name="gender" value="<?= $data['gender'] ?>"><br>
    Disease: <input type="text" name="disease" value="<?= $data['disease'] ?>"><br>
    <button name="update">Update</button>
</form>