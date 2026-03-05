<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    if (!empty($name) && !empty($email)) {
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;

        setcookie("username", $name, time() + 3600, "/"); // 1 hour expiry

        header("Location: dasshboard.php");
        exit();
    } else {
        echo "All fields are required!";
    }
}
?>

<form method="POST" action="form.php">
    Name: <input type="text" name="name"><br>
    Email: <input type="email" name="email"><br>
    <button type="submit">Login</button>
</form>