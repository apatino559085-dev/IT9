<?php
session_start();

if (!isset($_SESSION['name']) || !isset($_SESSION['email'])) {
    header("Location: form.php");
    exit();
}
?>

<h2>Welcome, <?php echo $_SESSION['name']; ?>!</h2>
<p>Your email: <?php echo $_SESSION['email']; ?></p>

<?php
if (isset($_COOKIE['username'])) {
    echo "<p>Cookie says: Hello, " . $_COOKIE['username'] . "!</p>";
}
?>

<a href="loogout.php">Logout</a> 