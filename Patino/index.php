<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    if (isset($users[$username]) && password_verify($password, $users[$username]["password"])) {
        $_SESSION["username"] = $username;
        setcookie("username", $username, time() + 86400, "/");
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid login credentials!";
    }
}
?>
<form method="POST" action="index.php">
    Username: <input type="text" name="username" value="<?php echo $_COOKIE['username'] ?? ''; ?>" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
<?php if(isset($error)) echo $error; ?>
<p>Don't have an account? <a href="signup.php">Sign up here</a></p>