<?php
include 'db.php';

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $disease = $_POST['disease'];

    $conn->query("INSERT INTO patients (name, age, gender, disease)
                  VALUES ('$name', '$age', '$gender', '$disease')");

    header("Location: index.php");
}
?>

<form method="POST">
    Name: <input type="text" name="name"><br>
    Age: <input type="number" name="age"><br>
    Gender: <input type="text" name="gender"><br>
    Disease: <input type="text" name="disease"><br>
    <button name="submit">Add</button>
</form>