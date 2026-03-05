<?php
session_start();
session_destroy();

setcookie("username", "", time() - 3600, "/"); // delete cookie

header("Location: form.php");
exit();
?>