<?php
session_start();

// Example user storage (array for demo)
$users = [
    "maria" => ["email" => "kapa@example.com", "password" => password_hash("mypassword123", PASSWORD_DEFAULT)]
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Validation
    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } elseif (strlen($password) < 6 || strlen($password) > 12) {
        $error = "Password must be 6–12 characters!";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } elseif (isset($users[$username])) {
        $error = "Username already exists!";
    } else {
        // Add new user (demo only, not persistent)
        $users[$username] = ["email" => $email, "password" => password_hash($password, PASSWORD_DEFAULT)];

        // Set session and cookie
        $_SESSION["username"] = $username;
        setcookie("username", $username, time() + 86400, "/");

        // Redirect with GET parameter
        header("Location: dashboard.php?user=" . urlencode($username));
        exit();
    }
}
?>
<form method="POST" action="signup.php">
    Username: <input type="text" name="username" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    Confirm Password: <input type="password" name="confirm_password" required><br>
    <button type="submit">Sign Up</button>
</form>
<?php if(isset($error)) echo $error; ?>

<!-- Example GET link for demonstration -->
<p>Test GET superglobal: <a href="dashboard.php?user=TestUser">Click here</a></p>