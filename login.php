<?php
session_start();

if(isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if($user == "admin" && $pass == "1234") {
        $_SESSION['admin'] = true;
        header("Location: index.php");
    } else {
        echo "Invalid Login";
    }
}
?>

<form method="POST">
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <button name="login">Login</button>
</form>